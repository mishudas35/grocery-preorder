<?php

namespace Axilweb\PreOrder\Controllers;

use Axilweb\PreOrder\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        //validation is not working
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validatedData);

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    public function index()
    {
        // Fetch all products
        $products = Product::all();

        // Return as JSON response
        return response()->json($products, 200);
    }
}
