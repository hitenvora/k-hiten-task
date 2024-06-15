<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppOrder;
use App\Models\AppOrderCart;
use App\Models\Cart;
use App\Models\PaymentLog;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppOrderController extends Controller
{
    public function storeOrder(Request $request)
    {
        try {
            $cart = Cart::where('cart_id', $request->cart_id)->first();
            if ($cart != null) {

                $order = new AppOrder();
                $order->cart_id = $cart->id;
                $order->total_text =  (int)$cart->taxes;
                $order->total =  (int)$cart->total_amount;
                $order->sub_total =  (int)$cart->sub_total;
                if ($cart->AppCustomer != null) {
                    $order->customer_name = $cart->AppCustomer->first_name;
                    $order->customer_contact_number = $cart->AppCustomer->contact_no;
                }
                $order->save();

                $cart->cart_id = '0';
                $cart->employee_id = '0';
                $cart->save();

                $response = [
                    'success' => true,
                    'data' => $order,
                    'error_flag' => 0,
                    'message' => 'Order Has Been Saved',
                ];

                $PaymentLog = new PaymentLog();
                $PaymentLog->perch_id = $order->id;
                // $PaymentLog->note = "Rs ".$order->total." credited from the bill number ".$order->id ." and debited from the ".$order->customer_name;
                $PaymentLog->note = "Rs " . $order->total . " credited from the bill number " . $order->id;
                $PaymentLog->rupee = $order->total;
                $PaymentLog->credit_debit = 0;
                $PaymentLog->payment_type = 0;
                $PaymentLog->save();

                $Entry = new Entry();
                $Entry->order_id = $order->id;
                // $Entry->narration = "Rs ".$order->total." credited from the bill number ".$order->id." and debited from the ".$order->customer_name;
                $Entry->narration = "Rs " . $order->total . " credited from the bill number " . $order->id;
                $Entry->rupee = $order->total;
                $Entry->credit_debit = 0;
                $order->payment_type = 0;
                $Entry->save();

                return response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'cart not found',
                ];
                return response()->json($response, 404);
            }
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

    public function listOrder()
    {
        try {
            $order = AppOrder::where('status', 0)->orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
            $response = [
                'success' => true,
                'data' => $order,
                'error_flag' => 0,
            ];
            return response()->json($response, 200);
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
    public function OrderReceipt($o_id)
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

            return view('admin-pages.app.order-receipt', compact('Allproducts','Gstproducts', 'cart','order'));
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

            return view('admin-pages.app.print-order-receipt', compact('Allproducts','Gstproducts', 'cart','order'));
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

    public function OrderToken($o_id)
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

            return view('admin-pages.app.print-order-token', compact('Allproducts','Gstproducts', 'cart','order'));
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
