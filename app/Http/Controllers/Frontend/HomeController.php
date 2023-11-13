<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;
class HomeController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();

        return view('frontend.home.home', compact ('flashSaleDate'));
    }
}
