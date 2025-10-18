<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderByDesc('id')->get();
        return view('products.index', compact('products'));
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id'
        ]);
        
        $data = $request->only(['name', 'description', 'price', 'stock']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName); 
            $data['image'] = $imageName;
        }

        $product = Product::create($data);
        
        // Attach categories to product
        $product->categories()->attach($request->categories);
        
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show',compact('product'));
        // return view('products.show',['product'->$product]);
        
    }
    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit',compact('product'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:1000000000',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $name = $request->input('name');
        $description = $request->input('description');
        $stock = $request->input('stock');
        $price =$request->input('price');
        $product = Product::findOrFail($id);
        $product->update(
            [
                'name'=> $name ,
                'description' => $description,
                'stock' => $stock,
                'price' => $price,

                ]
            );
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $product->update(['image' => $imageName]);
        }

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }
}


