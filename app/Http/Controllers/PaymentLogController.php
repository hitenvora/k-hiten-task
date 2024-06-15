<?php

namespace App\Http\Controllers;

use App\Models\PaymentLog;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class PaymentLogController extends Controller
{
    public function newOrder(): View
    {
        $PaymentLog = PaymentLog::orderBy('id', 'DESC')->get();
        return view('admin-pages/payment-log/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'PaymentLog' => $PaymentLog,
            'layout' => 'side-menu'
        ]);
    }
}
    