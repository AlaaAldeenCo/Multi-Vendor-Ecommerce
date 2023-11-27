<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
class HomeController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();

        return view('frontend.home.home', compact ('flashSaleDate','flashSaleItems', 'popularCategory'));
    }
}
