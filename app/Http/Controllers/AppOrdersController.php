<?php

namespace App\Http\Controllers;

use App\Models\AppOrder;
use App\Models\AppOrderCart;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;


class AppOrdersController extends Controller
{
    public function appOrderList(): View
    {
        try {
            $orders = AppOrder::where('status', 0)->orderBy('id', 'DESC')->get();
            return view('admin-pages/app/order-list', [
                // Specify the base layout.
                // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
                // The default value is 'side-menu'
                'orders' => $orders,
                'layout' => 'side-menu'
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function printOrderReceipt($o_id)
    {
        try {
            $order = AppOrder::findOrFail($o_id);
            if ($order == null) {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Order not found',
                ];
                return response()->json($response, 404);
            }
            $cart = Cart::where('id', $order->cart_id)->first();
            if ($cart == null) {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Order Product not found',
                ];
                return response()->json($response, 404);
            }
            $Allproducts = AppOrderCart::where('cart_id', $order->cart_id)
                ->orderBy('id', 'DESC')->get()
                ->groupBy('firm_id');


            $Gstproducts = AppOrderCart::where('cart_id', $order->cart_id)
                ->orderBy('gst_p', 'DESC')->get()
                ->groupBy('gst_p');

            if ($Allproducts->count() == 0) {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Order Product not found in Cart',
                ];
                return response()->json($response, 404);
            }

            return view('admin-pages.app.web-print-order-receipt', compact('Allproducts', 'Gstproducts','cart','order'));
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ];
            return response()->json($response, 500); // HTTP status code for Internal Server Error
        }
    }
}
