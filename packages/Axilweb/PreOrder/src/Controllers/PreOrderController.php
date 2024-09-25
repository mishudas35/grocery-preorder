<?php
namespace Axilweb\PreOrder\Controllers;

use Axilweb\PreOrder\Services\PreOrderService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PreOrderController extends Controller
{
    protected $preOrderService;

    public function __construct(PreOrderService $preOrderService)
    {
        $this->preOrderService = $preOrderService;
    }

    /**
     * Display a paginated list of pre-orders.
     */
    public function index(Request $request)
    {
        try {
            $preOrders = $this->preOrderService->getPreOrders($request);
            return response()->json($preOrders, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch pre-orders'], 500);
        }
    }

    /**
     * Store a new pre-order.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request and create a pre-order
            $preOrder = $this->preOrderService->createPreOrder($request);

            return response()->json([
                'message' => 'Pre-order saved successfully',
                'preOrder' => $preOrder,
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Delete a pre-order.
     */
    public function destroy($id)
    {
        try {
            $this->preOrderService->deletePreOrder($id);
            return response()->json(['message' => 'Pre-order deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
