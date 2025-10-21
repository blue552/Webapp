<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    { 
       $categories = Category::orderByDesc('id')->get();
       return view('categories.index',compact('categories'));
    }
    public function show($slug)
    {
        $category = Category::where('slug',$slug)->firstOrFail();
        $products = $category->products()->orderByDesc('id')->get();
        return view('categories.show',compact('category','products'));
    }
}
