<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaypalSetting;
use App\Models\RazorpaySetting;
class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypalSetting = PaypalSetting::first();
        // $stripeSetting = StripeSetting::first();
        $razorpaySetting = RazorpaySetting::first();
        // $codSetting = CodSetting::first();


        return view('admin.payment-settings.index', compact('paypalSetting','razorpaySetting'));
    }
}
