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

    /* Add Product to Cart */
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
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;


        Cart:: add($cartData);
        return response(['status' => 'success', 'message' => 'Added to cart successfully!']);
    }

    /* Update Quantity */
    public function updateProductQty(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);
        if($product->qty ===0)
        {
            return response(['status' => 'error', 'message' => 'Product stock out']);
        }

        else if($product->qty < $request->qty)
        {
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status' => 'success', 'message' => 'Product Quantity Updated!', 'product_total' => $productTotal]);
    }

    /* Get Total Price */
    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    /* Clear Cart */
    public function clearCart()
    {
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart cleared successfully']);
    }

     /** Remove Product Form Cart */
    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Product removed succesfully!', 'success', 'Success');
        return redirect()->back();
    }
    public function getCartCount()
    {
        return Cart::content()->count();
    }

    public function getCartProducts()
    {
        return Cart::content();
    }

    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' => 'Product removed successfully!']);
    }
}



