<?php

use Illuminate\Support\Facades\Session;
// Make Sidebar item active

function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

/* Check If The Product Have Discount */

function checkDiscount($product)
{
    $currentDate = date('Y-m-d');
    if($product->offer_price >0 && $product->offer_start_date <= $currentDate && $currentDate <= $product->offer_end_date )
    {
        return true;
    }
    return false;
}



/* Calculate Discount in percernt */

function calculateDiscountPercent($originalPrice, $discountPrice)
{
    $discountAmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice) * 100;
    return round($discountPercent);
}

/* Check The Product Type */

function productType($type)
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;

        case 'best_product':
            return 'Best';
            break;

        default:
            return '';
            break;
    }
}

// Get Total Cart Price
function getCartTotal()
{
    $total = 0;
    foreach(\Cart::content() as $product)
    {
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}


/** get payable total amount */
function getMainCartTotal(){
    if(Session::has('coupon'))
    {
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] === 'amount')
        {
            $total = $subTotal - $coupon['discount'];
            return $total;
        }
        elseif($coupon['discount_type'] === 'percent')
        {
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            $total = $subTotal - $discount;
            return $total;
        }
    }
    else
    {
        return getCartTotal();
    }
}

/** get cart discount */
function getCartDiscount()
{
    if(Session::has('coupon'))
    {
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] === 'amount')
        {
            return $coupon['discount'];
        }
        elseif($coupon['discount_type'] === 'percent')
        {
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            return $discount;
        }
    }
    else
    {
        return 0;
    }
}
