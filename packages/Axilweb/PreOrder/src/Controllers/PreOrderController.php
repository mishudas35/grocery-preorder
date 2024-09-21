<?php

namespace Axilweb\PreOrder\Controllers;

use Axilweb\PreOrder\Models\PreOrder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PreOrderController extends Controller
{
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
        ]);

        // Save the validated data to the database
        $preOrder = PreOrder::create($validatedData);

        // Return a success response
        return response()->json([
            'message' => 'Pre-order saved successfully',
            'preOrder' => $preOrder
        ], 201);
    }
}
