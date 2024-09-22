<?php

namespace Axilweb\PreOrder\Controllers;

use Axilweb\PreOrder\Models\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class PreOrderController extends Controller
{
    public function index(Request $request)
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
        $preOrders = $query->paginate($request->input('per_page', 10));

        // Return the paginated results as a JSON response
        return response()->json($preOrders);
    }

    /**
     * Store a new pre-order.
     */
    public function store(Request $request)
    {
        // Validate and sanitize incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'product_id' => 'required|exists:products,id',
            'recaptchaToken' => 'required', // Validate reCAPTCHA
        ]);

        // Verify reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'), // Get secret from config
            'response' => $request->input('recaptchaToken'),
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if (!$responseBody['success']) {
            return response()->json(['error' => 'reCAPTCHA validation failed.'], 422);
        }

        // Save the validated data to the database
        $preOrder = PreOrder::create($validatedData);

        // Return a success response
        return response()->json([
            'message' => 'Pre-order saved successfully',
            'preOrder' => $preOrder
        ], 201);
    }
}
