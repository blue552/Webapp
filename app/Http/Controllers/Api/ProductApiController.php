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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);
        
        $data = $request->only(['name', 'description', 'price', 'stock']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images/products', $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        $product = Product::create($data);
        
        // Attach categories if provided
        if ($request->has('categories')) {
            $product->categories()->attach($request->categories);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product->load('categories')
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $data = $request->only(['name', 'description', 'price', 'stock']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && \Storage::exists('public/' . $product->image)) {
                \Storage::delete('public/' . $product->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images/products', $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        $product->update($data);

        // Update categories if provided
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product->load('categories')
        ]);
    }

    public function destroy(int $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        // Delete image file if exists
        if ($product->image && \Storage::exists('public/' . $product->image)) {
            \Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}   


