<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVrefication;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class NewsletterController extends Controller
{
    public function newsLetterRequset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);
        $existSubscriber = NewsletterSubscriber::where('email', $request->email)->first();
        if(!empty($existSubscriber))
        {
            if($existSubscriber->is_verified == 0)
            {

            }
            elseif($existSubscriber->is_verified == 1)
            {
                return response(['status' => 'error', 'message' => 'You already subscribed with this email!']);
            }

        }
        else
        {
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token =\Str::random(20);
            $subscriber->is_verified =0;
            $subscriber->save();
            MailHelper::setMailConfig();
            Mail::to($subscriber->email)->send(new SubscriptionVrefication($subscriber));
            return response(['status' => 'success', 'message' => 'A verification link has been sent to your email please check']);
        }
    }

    public function newsLetterEmailVarify($token)
    {
        dd($token);
    }
}
