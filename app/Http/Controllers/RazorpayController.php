<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function createOrder()
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create(array(
            'receipt' => 'order_rcptid_11',
            'amount' => 500, // Amount in paise (500 paise = 5 INR)
            'currency' => 'INR'
        ));

        $orderId = $order['id'];

        return view('payment-page', compact('orderId'));
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            if ($payment['status'] == 'captured') {
                return 'Payment successful!';
            } else {
                return 'Payment failed!';
            }
        }

        return 'Payment failed!';
    }
}
