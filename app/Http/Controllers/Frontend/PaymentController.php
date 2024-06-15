<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class PaymentController extends Controller
{
    public function paymentView(): View
    {
        $Cart = Cart::where('employee_id', Auth::user()->id)->first();
        $cart_product = null;

        if ($Cart != null) {
        $cart_product = WebOrderCart::where('cart_id', $Cart->id)->with('Product')->get();
        }
        $totalTax = $cart_product->sum('taxes');
        $totalMrp = $cart_product->sum(function ($cartItem) {
            return $cartItem->product->mrp;
        });
        


        
        return view('front-pages/payment', [
            // 'prodcut_cetegory' => $prodcut_cetegory,
            // 'product' => $product,
            // 'populer_product' => $populer_product,
            'cart_product' => $cart_product,
            'totalTax' => $totalTax,
            'totalMrp' => $totalMrp,


        ]);
    }
}
