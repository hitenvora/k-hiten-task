<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\OrderAddress;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\WebOrderCart;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppOrder;
use Illuminate\View\View;


class AddressController extends Controller
{
    public function addressView($type): View
    {
        // $prodcut_cetegory = SubCategory::orderBy('id', 'desc')->get();
        $prodcut_cetegory = SubCategory::paginate(7);
        $product = Product::paginate(9);
        $populer_product = Product::where('populer', 1);
        $auth = auth()->user()->id;
        $cart_product = null;
        $totalTax = null;
        $totalMrp = null;
        $addresses = null;

        

        $Cart = Cart::where('employee_id', Auth::user()->id)->first();
        if ($Cart != null) {
            $cart_product = WebOrderCart::where('cart_id', $Cart->id)->with('Product')->get();
            $totalTax = $cart_product->sum('taxes');
            $totalMrp = $cart_product->sum(function ($cartItem) {
                return $cartItem->product->mrp;
            });
        }
        $addresses = OrderAddress::where('user_id', auth()->user()->id)
            ->first();




        $address_show = OrderAddress::where('user_id', auth()->user()->id)->firstOrFail();


        // dd($cart_product);
        return view('front-pages/address', [
            'prodcut_cetegory' => $prodcut_cetegory,
            'product' => $product,
            'populer_product' => $populer_product,
            'cart_product' => $cart_product,
            'totalTax' => $totalTax,
            'totalMrp' => $totalMrp,
            'type' => $type,
            // 'id' => $id,
            'addresses' => $addresses,

        ]);
    }

    public function saveOrderAddressDetails(Request $request)
    {
        // try {
        // dd($request->all());
        // Remove _token from the request data
        $requestData = $request->except('_token');

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
            'contry' => 'required',
            'city' => 'required',
            'state' => 'required',
            'addresss' => 'required',
            'landmark' => 'required',
            'pincode' => 'required',
        ]);


        $deliveryDays = 3; // Change this value as needed
        $expectedDeliveryDate = date('Y-m-d', strtotime('+' . $deliveryDays . ' days'));

        $auth = auth()->user()->id;

        $existingAddress = OrderAddress::where('user_id', $auth)->where('address_type', $request->address_type)->first();

        if ($existingAddress) {
            $existingAddress->update($requestData);
        } else {
            $requestData['user_id'] = $auth;

            $existingAddress = OrderAddress::create($requestData);
        }
        $auth = auth()->user()->id;

        $cart = Cart::where('id', $request->cart_id)->first();
        if ($cart != null) {

            $web_confirm_order = new AppOrder();
            $web_confirm_order->cart_id = $request->cart_id;
            $web_confirm_order->total_text = $request->total_text;
            $web_confirm_order->sub_total = $request->sub_total;
            $web_confirm_order->total = $request->total;
            $web_confirm_order->address_id = $existingAddress->id;
            $web_confirm_order->expected_delivery_date = $expectedDeliveryDate ;
            $web_confirm_order->ship_to_name = 'Kanaiya Dairy' ;
            $web_confirm_order->type = 1;
            $web_confirm_order->user_id = $auth;
            

            $web_confirm_order->save();
            $cart->cart_id = '0';
            $cart->employee_id = '0';
            $cart->save();
        } else {
            return redirect()->back()->with('error', 'cart not found');
        }


        return redirect()->route('order.view')->with('success', 'Your Payment Send Successfully!');

        return redirect()->route('payment.view')->with('success', 'OrderAddress Details saved successfully!');
        // } catch (\Exception $e) {
        //     // dd($e);
        //     // Handle other exceptions
        //     return redirect()->back()->with('error', 'An error occurred while saving the OrderAddress data.');
        // }
    }
}
