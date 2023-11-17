<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use App\Models\ProductVariantItem;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{

    /* Show Cart Details Page */
    public function cartDetails()
    {
        $cartItems = Cart:: content();

        return view('frontend.pages.cart-detail', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        // dd($request->variants_items);
        $product = Product::findOrFail($request->product_id);
        $variants=[];
        $variantTotalAmount = 0;
        if($request->has('variants_items'))
        {
            foreach($request->variants_items as $item_id)
            {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount = $variantTotalAmount + $variantItem->price;
            }
        }


        $productPrice = 0;
        if(checkDiscount($product))
        {
            $productPrice = $product->offer_price;
        }
        else
        {
            $productPrice = $product->price;
        }


        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $product->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        // dd($cartData);
        Cart:: add($cartData);
        return response(['status' => 'success', 'message' => 'Added to cart successfully!']);
    }

    public function updateProductQty(Request $request)
    {
        // $productId = Cart::get($request->rowId);
        Cart::update($request->rowId, $request->quantity);
        return response(['status' => 'success', 'message' => 'Product Quantity Updated!']);
    }
}
