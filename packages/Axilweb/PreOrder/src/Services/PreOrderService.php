<?php
namespace Axilweb\PreOrder\Services;

use App\Mail\PreOrderAdminNotification;
use App\Mail\PreOrderUserConfirmation;
use Axilweb\PreOrder\Models\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PreOrderService
{
    /**
     * Get pre-orders with pagination, filtering, and sorting.
     */
    public function getPreOrders(Request $request)
    {
        // Define the query for pre-orders, eager loading the product relationship
        $query = PreOrder::with('product');

        // Search by name or email if the search parameter is provided
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        // Apply ordering if the order_by parameter is provided (default to 'id')
        $orderBy = $request->input('order_by', 'id');
        $orderDirection = $request->input('order_direction', 'asc');
        $query->orderBy($orderBy, $orderDirection);

        // Paginate the results (default 10 per page)
        return $query->paginate($request->input('per_page', 10));
    }

    public function createPreOrder(Request $request)
    {
        // Validate request data
        $validatedData = $this->validatePreOrder($request);

        // Verify reCAPTCHA
        if (!$this->verifyRecaptcha($validatedData['recaptchaToken'])) {
            return response()->json(['message' => 'reCAPTCHA validation failed.'], 422);
        }

        // Create preorder in the database
        $preOrder = $this->storePreOrder($validatedData);

        // Send confirmation emails to both admin and user
        $this->sendPreOrderEmails($preOrder);

        return response()->json(['message' => 'Pre-order created successfully!', 'preOrder' => $preOrder], 201);
    }

    protected function validatePreOrder(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'product_id' => 'required|exists:products,id',
            'recaptchaToken' => 'required',
        ]);
    }

    protected function verifyRecaptcha($recaptchaToken)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'), // Ensure the secret is set in config/services.php
            'response' => $recaptchaToken,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return $responseBody['success'] ?? false;
    }

    public function storePreOrder(array $validatedData)
    {
        return PreOrder::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'product_id' => $validatedData['product_id'],
        ]);
    }

    public function sendPreOrderEmails(PreOrder $preOrder)
    {
        // Queue email to the admin
        Mail::to(env('ADMIN_EMAIL', 'admin@example.com'))->queue(new PreOrderAdminNotification($preOrder));

        // Queue confirmation email to the user
        Mail::to($preOrder->email)->queue(new PreOrderUserConfirmation($preOrder));
    }

    /**
     * Delete a pre-order by ID.
     */
    public function deletePreOrder($id)
    {
        // Find the pre-order by ID
        $preOrder = PreOrder::find($id);

        // Check if the pre-order exists
        if (!$preOrder) {
            throw new \Exception('Pre-order not found.');
        }

        // Soft delete the pre-order
        $preOrder->delete();
    }
}
