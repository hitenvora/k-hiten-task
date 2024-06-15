<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    
 
public function create(Request $request)
{
    $api = new Api(config('razorpay.key'), config('razorpay.secret'));
    
    $order = $api->order->create([
        'receipt'         => 'order_rcptid_' . rand(),
        'amount'          => $request->amount * 100, // Amount in paisa
        'currency'        => 'INR',
        'payment_capture' => 1 // Auto capture payment
    ]);
 
    return view('payment')->with([
        'order' => $order,
        'key' => config('razorpay.key')
    ]);
}
}
