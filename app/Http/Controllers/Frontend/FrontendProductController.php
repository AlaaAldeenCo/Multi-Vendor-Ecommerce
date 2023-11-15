<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FrontendProductController extends Controller
{
    public function showProduct( string $slug)
    {
        $product = Product::with(['vendor', 'Category', 'brand', 'productImageGalleries', 'variants'])->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-detail', compact('product'));
    }
}
