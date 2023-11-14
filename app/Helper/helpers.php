<?php

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
