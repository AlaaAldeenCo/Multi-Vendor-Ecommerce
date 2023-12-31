<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Adverisement;
use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use App\Models\ProductVariantItem;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
class CartController extends Controller
{

    /* Show Cart Details Page */
    public function cartDetails()
    {
        $cartItems = Cart:: content();
        if(count($cartItems) === 0)
        {
            Session::forget('coupon');
            toastr('Please add some products in your cart for view the cart page', 'warning', 'Cart is empty!');
            return redirect()->route('home');
        }

        $cartpage_banner_section = Adverisement::where('key', 'cartpage_banner_section')->first();
        $cartpage_banner_section = json_decode($cartpage_banner_section?->value);

        return view('frontend.pages.cart-detail', compact('cartItems', 'cartpage_banner_section'));
    }

    /* Add Product to Cart */
    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);

        // Check Product Quntity
        if($product->qty === 0)
        {
            return response(['status' => 'error', 'message' => 'Product stock out']);
        }

        if($product->qty < $request->qty)
        {
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }

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

        // check product quantity
        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Product stock out']);
        }else if($product->qty < $request->qty){
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

     /* Remove Product Form Cart */
    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Product removed succesfully!', 'success', 'Success');
        return redirect()->back();
    }

    /* Get Cart Count */
    public function getCartCount()
    {
        return Cart::content()->count();
    }

    /* Get Cart Products */
    public function getCartProducts()
    {
        return Cart::content();
    }

    /* Remove Sidebar Product */
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' => 'Product removed successfully!']);
    }

    /* Get Cart Sidebar Total */
    public function getCartTotal()
    {
        $total =0;
        foreach(Cart::content() as $product)
        {
            $total+= $this->getProductTotal($product->rowId);
        }
        return $total;
    }

     /* Apply Coupon */
     public function applyCoupon(Request $request)
     {
         if($request->coupon_code === null)
         {
             return response(['status' => 'error', 'message' => 'Coupon filed is required']);
         }

         $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

         if($coupon === null)
         {
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
         }

         elseif($coupon->start_date > date('Y-m-d'))
         {
             return response(['status' => 'error', 'message' => 'Coupon not exist!']);
         }

         elseif($coupon->end_date < date('Y-m-d'))
         {
             return response(['status' => 'error', 'message' => 'Coupon is expired']);
         }

         elseif($coupon->total_used >= $coupon->quantity)
         {
             return response(['status' => 'error', 'message' => 'you can not apply this coupon']);
         }

         if($coupon->discount_type === 'amount')
         {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
         }
         elseif($coupon->discount_type === 'percent')
         {
             Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
             ]);
         }

         return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
     }

    /* Calculate Total Amount After Apllying Coupon */
    public function couponCalculation()
    {
        if(Session::has('coupon'))
        {
            $coupon = Session::get('coupon');
            $subTotal = getCartTotal();
            if($coupon['discount_type'] === 'amount')
            {
                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            }
            elseif($coupon['discount_type'] === 'percent')
            {
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        }

        else
        {
            $total = getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }
}



