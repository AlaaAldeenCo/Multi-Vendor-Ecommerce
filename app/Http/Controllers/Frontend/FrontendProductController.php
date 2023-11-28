<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class FrontendProductController extends Controller
{
    public function showProduct( string $slug)
    {
        $product = Product::with(['vendor', 'Category', 'brand', 'productImageGalleries', 'variants'])->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-detail', compact('product'));
    }

    public function productsIndex(Request $request)
    {
        if($request->has('category'))
        {
            $category = Category::where('slug', $request->category)->first();
            $products = Product::where([
                'category_id' => $category->id,
                'status' => 1,
                'is_approved' => 1
            ])->paginate(12);
        }
        return view('frontend.pages.product', compact('products'));
    }
}
