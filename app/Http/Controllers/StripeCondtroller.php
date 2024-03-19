<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StripeCondtroller extends Controller
{
    public function index($price)
    {
        $user = auth()->user();
        return view('stripe.index', [
            'intent' => $user->createSetupIntent(),
            'price' => $price
        ]);
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function charge(Request $request)
    {
        $amount = $request->get('amount') * 100;
        $payment_method = $request->get('payment_method');

        $user = auth()->user();
        $user->createOrGetStripeCustomer();

        $payment_method = $user->addPaymentMethod($payment_method);

        $user->charge($amount, $payment_method->id);

        return view('subscribed');
    }
}
