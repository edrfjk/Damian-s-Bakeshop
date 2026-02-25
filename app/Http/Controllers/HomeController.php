<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->where('stock', '>', 0)
            ->latest()
            ->limit(6)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->withCount('products')
            ->get();

        return view('home', compact('featuredProducts', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}