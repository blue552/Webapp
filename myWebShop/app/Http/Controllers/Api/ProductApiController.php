<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')->get();
        return response()->json($products);
    }
   

    public function show(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            
        ]);
        
        $data = $request->only(['name', 'description', 'price', 'stock']);
        $product = Product::create($data);
        return response()->json([
            'json_post_success' => true,
            'product' => $product,
        ], 201);
    }
}   


