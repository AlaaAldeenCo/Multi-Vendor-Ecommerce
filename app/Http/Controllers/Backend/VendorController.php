<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function dashboard()
    {
        $todaysOrder = Order::whereDate('created_at', Carbon::today())->whereHas('orderProducts',function($query)
        {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $todaysPendingOrder = Order::whereDate('created_at', Carbon::today())->where('order_status', 'pending')
        ->whereHas('orderProducts', function($query)
        {
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalOrder = Order::whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalPendingOrder = Order::where('order_status', 'pending')
        ->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalCompleteOrder = Order::where('order_status', 'delivered')
        ->whereHas('orderProducts', function($query){
            $query->where('vendor_id', Auth::user()->vendor->id);
        })->count();

        $totalProducts = Product::where('vendor_id', Auth::user()->vendor->id)->count();

        return view('vendor.dashboard.dashboard', compact(
            'todaysOrder',
            'todaysPendingOrder',
            'totalOrder',
            'totalPendingOrder',
            'totalCompleteOrder',
            'totalProducts'
        ));
    }
}
