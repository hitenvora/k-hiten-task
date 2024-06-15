<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppOrder;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\OrderAddress;
use App\Models\Product;
use App\Models\User;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class WebOrderController extends Controller
{
    public function orderView(): View
    {

        if (Auth::check()) { // Check if user is authenticated
            $auth = auth()->user()->id;
            $order_address = OrderAddress::where('user_id', $auth)->first();
        }


        $cart_product = WebOrderCart::where('user_id', $auth)->with('Product')->get();

        $totalTax = $cart_product->sum('taxes');
        $totalMrp = $cart_product->sum(function ($cartItem) {
            return $cartItem->product->mrp;
        });

        $web_order = AppOrder::where('user_id', $auth)->where('is_delivery', '!=', '1')->orderBy('id', 'desc')->get();

        // dd($web_order);
        // $web_order = AppOrder::where('user_id', $auth)->orderBy('id', 'desc')->first();


        $auth = auth()->user()->id;
        // dd($auth);
        // $date = AppOrder::where('cart_id');

        $delivery_order = AppOrder::where('user_id', $auth)->where('is_delivery', '1')->orderBy('id', 'desc')->get();
        // $delivery_order = AppOrder::where('user_id', $auth)->where('is_delivery', '1')->first();



        // dd($delivery_order);

        return view('front-pages/order', [
            'cart_product' => $cart_product,
            'totalTax' => $totalTax,
            'totalMrp' => $totalMrp,
            'order_address' => $order_address,
            'web_order' => $web_order,
            'delivery_order' => $delivery_order,

        ]);
    }

    // public function add_to_cart(Request $request)
    // {
    //     try {

    //         $Product = Product::where('id', $request->product_id)->first();
    //         $taxes = 0;
    //         $cartItem_gst = [];
    //         $taxesList = json_decode($Product->gst);
    //         foreach ($taxesList as $gst) {
    //             foreach ($gst as $key => $value) {
    //                 if ($key == 'GST') {
    //                     $gst_p = $value;
    //                 }
    //                 $cartItem_gst[$key] = ($Product->per_kg_price * (($value / 100)));
    //                 $taxes = $taxes + $value;
    //             }
    //         }
    //         // $taxe = ($Product->per_kg_price - $Product->text_prize) ;
    //         $taxe = ($Product->per_kg_price - $Product->text_prize);



    //         $productId = $request->input('product_id');
    //         $user = auth()->user()->id;
    //         $cartItem = new WebOrderCart();
    //         $cartItem->user_id = $user;
    //         $cartItem->product_id = $productId;
    //         $cartItem->taxes = $taxe;

    //         $cartItem->save();

    //         return redirect()->route('product.view')->with('success', 'Your Product Cart Added Successfully!');
    //     } catch (\Exception $e) {
    //         dd($e);                // Handle other exceptions
    //         return redirect()->back()->with('error', 'An error occurred errore Plase try again.');
    //     }
    // }




    public function add_to_cart(Request $request)
    {
        try {

            $User = User::where('id', auth()->user()->id)->first();
            if ($User != null) {
                $cart = Cart::where('employee_id', auth()->user()->id)->first();
                $Product = Product::where('id', $request->product_id)->first();

                $product_quntity = $request->input('product_quntity');

                if ($cart != null) {
                    $CartProduct = WebOrderCart::where('cart_Id', $cart->id)->where('product_id', $request->product_id)->where('user_id', auth()->user()->id)->first();

                    if ($CartProduct != null) {

                        if ($CartProduct->Product->lush != 1) {
                            $product_quntity = $product_quntity + $CartProduct->product_quntity;
                        }
                    }
                }
                $product_idInventory = Inventory::where('product_id', $Product->id)->first();
                if ($Product != null) {
                    if ((int) $product_quntity > (int) $product_idInventory->inventorie) {
                        TriggerStock($Product->id);
                    }
                    if (isset($CartProduct) && $CartProduct != null) {
                        $product_idInventory = Inventory::where('product_id', $CartProduct->product_id)->first();
                        $product_idInventory->inventorie = $product_idInventory->inventorie + $CartProduct->product_quntity;

                        $product_idInventory->save();
                        $CartProduct->delete();
                    }
                    if ($cart == null) {
                        for ($cart_Id = 51; $cart_Id <= 1000; $cart_Id++) {
                            $cartid = Cart::where('cart_Id', $cart_Id)->first();
                            if ($cartid == null) {
                                $cart = new Cart();
                                $cart->cart_id = $cart_Id;
                                $cart->employee_id = $User->id;
                                $cart->sub_total = 0;
                                $cart->taxes = 0;
                                $cart->total_amount = 0;
                                $cart->save();
                                break;
                            }
                        }
                    }

                    $taxes = 0;
                    $cartItem_gst = [];
                    $taxesList = json_decode($Product->gst);
                    foreach ($taxesList as $gst) {
                        foreach ($gst as $key => $value) {
                            if ($key == 'GST') {
                                $gst_p = $value;
                            }
                            $cartItem_gst[$key] = ($Product->per_kg_price * (($value / 100))) * $product_quntity;
                            $taxes = $taxes + $value;
                        }
                    }
                    // $taxe = ($Product->per_kg_price - $Product->text_prize) * $product_quntity;
                    $taxe = ($Product->per_kg_price - $Product->text_prize) * $product_quntity;


                    $cartItem = new WebOrderCart();
                    $cartItem->cart_Id = $cart->id;
                    $cartItem->user_id = $User->id;
                    $cartItem->product_id = $request->input('product_id');
                    $cartItem->firm_id = $Product->firm_id;
                    $cartItem->gst_p = $gst_p;

                    $cartItem->product_quntity = $product_quntity;

                    $cartItem->product_weight = $request->input('product_Weight');
                    if ($Product->text_prize != 0) {
                        if ($Product->lush != 1) {
                            $cartItem->product_price = $Product->text_prize;
                            $cartItem->taxes = $taxe;
                        } else {

                            $gsts = 0;
                            foreach ($taxesList as $gst) {
                                foreach ($gst as $key => $value) {
                                    try {
                                        $gsts = (float) $gsts + (float) $value;
                                    } catch (\Throwable $th) {
                                    }
                                }
                            }
                            $text_prize = round((float) $Product->per_kg_price / (($gsts / 100) + 1), 3);
                            $cartItem->product_price = $text_prize;
                            $cartItem->taxes = $Product->per_kg_price - $text_prize;
                        }
                    } else {
                        $cartItem->product_price = $Product->per_kg_price;
                        $cartItem->taxes = 0;
                    }
                    $cartItem->gst = json_encode($cartItem_gst);

                    if ($cartItem->product_quntity != 0) {
                        $cartItem->sub_total = $cartItem->product_price * $cartItem->product_quntity;
                    } else {
                        $cartItem->sub_total = $cartItem->product_price;
                    }

                    $cartItem->total_amount = $cartItem->sub_total + $cartItem->taxes;
                    $cartItem->save();

                    $Inventory = Inventory::where('product_id', $cartItem->product_id)->first();

                    if ($Inventory == null) {
                        $Inventory = new Inventory();
                        $Inventory->product_id = $cartItem->product_id;
                    }
                    $Inventory->inventorie = $Inventory->inventorie - $cartItem->product_quntity;
                    $Inventory->save();


                    $data = [];
                    $data['cart_Id'] = $cart->cart_id;
                    $data['employee_id'] = $cart->employee_id;
                    $data['cart_sub_total'] = $cart->sub_total;
                    $data['cart_taxes'] = $cart->taxes;
                    $data['cart_total_amount'] = $cart->total_amount;

                    $AppCartProduct = WebOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();

                    foreach ($AppCartProduct as $List) {
                        $data['product'][] = [
                            "product_price" => $List->product_price,
                            "product_quntity" => $List->product_quntity,
                            "taxes" => $List->taxes,
                            "sub_total" => $List->sub_total,
                            "total_amount" => $List->total_amount,

                            "product_name" => $List->Product->product_name,
                            "product_image" => $List->Product->image,

                        ];
                    }
                    return redirect()->route('product.view')->with('success', 'Your Product Cart Added Successfully!');
                } else {
                    return back()->with('error', 'Product not found!');
                }
            } else {

                return back()->with('error', 'user not found!');
            }
            return back()->with('success', 'Product Add in cart successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Something wrong!');
        }
    }


    public function update_Qty(Request $request)
    {
        try {

            $User = User::where('id', auth()->user()->id)->first();
            if ($User != null) {
                $cart = Cart::where('employee_id', auth()->user()->id)->first();
                if ($cart == null) {
                    $response = [
                        'success' => false,
                        'data' => '',
                        'error_flag' => 1,
                        'message' => 'cart not found',
                    ];
                    return response()->json($response);
                }
                $cartProduct = WebOrderCart::where('cart_id', $cart->id)->where('product_id', $request->product_id)->first();


                if ($cartProduct == null) {
                    $response = [
                        'success' => false,
                        'data' => '',
                        'error_flag' => 1,
                        'message' => 'Order Product not found in Cart',
                    ];
                    return response()->json($response);
                }

                $product_idInventory = Inventory::where('product_id', $cartProduct->product_id)->first();
                if ($request->input('product_quntity') - $cartProduct->product_quntity > (int) $product_idInventory->inventorie) {
                    TriggerStock($cartProduct->product_id);
                }

                $Inventory = Inventory::where('product_id', $cartProduct->product_id)->first();

                if ($Inventory == null) {
                    $Inventory = new Inventory();
                    $Inventory->product_id = $cartProduct->product_id;
                }
                $Inventory->inventorie = $Inventory->inventorie + $cartProduct->product_quntity;
                $Inventory->save();

                $Product = Product::where('id', $cartProduct->product_id)->first();


                $Product = Product::where('id', $cartProduct->product_id)->first();

                if ($Product != null) {
                    $taxes = 0;
                    $cartItem_gst = [];
                    $taxesList = json_decode($Product->gst);
                    foreach ($taxesList as $gst) {
                        foreach ($gst as $key => $value) {
                            $cartItem_gst[$key] = ($Product->per_kg_price * (($value / 100))) * $request->input('product_quntity');
                            $taxes = $taxes + $value;
                        }
                    }
                    // $taxe = ($Product->per_kg_price - $Product->text_prize) * $request->input('product_quntity');

                    $taxe = ($Product->per_kg_price - $Product->text_prize) * $request->input('product_quntity');

                    $cartItem = new WebOrderCart();
                    $cartItem->id = $cartProduct->id;
                    $cartItem->cart_Id = $cart->id;
                    $cartItem->user_id = $User->id;
                    $cartItem->product_id = $Product->id;
                    $cartItem->firm_id = $Product->firm_id;
                    $cartItem->product_quntity = $request->input('product_quntity');
                    $cartItem->product_weight = $request->input('product_Weight');
                    if ($Product->text_prize != 0) {
                        if ($Product->lush != 1) {
                            $cartItem->product_price = $Product->text_prize;
                            $cartItem->taxes = $taxe;
                        } else {

                            $gsts = 0;
                            foreach ($taxesList as $gst) {
                                foreach ($gst as $key => $value) {
                                    try {
                                        $gsts = (float) $gsts + (float) $value;
                                    } catch (\Throwable $th) {
                                    }
                                }
                            }
                            $text_prize = round((float) $Product->per_kg_price / (($gsts / 100) + 1), 3);
                            $cartItem->product_price = $text_prize;
                            $cartItem->taxes = $Product->per_kg_price - $text_prize;
                        }
                    } else {
                        $cartItem->product_price = $Product->per_kg_price;
                        $cartItem->taxes = 0;
                    }
                    // $cartItem->taxes = $taxe;
                    $cartItem->gst = json_encode($cartItem_gst);


                    if ($cartItem->product_quntity != 0) {
                        $cartItem->sub_total = $cartItem->product_price * $cartItem->product_quntity;
                    } else {
                        $cartItem->sub_total = $cartItem->product_price;
                    }


                    $cartItem->total_amount = $cartItem->sub_total + $taxe;

                    $Inventory = Inventory::where('product_id', $cartItem->product_id)->first();

                    if ($Inventory == null) {
                        $Inventory = new Inventory();
                        $Inventory->product_id = $cartItem->product_id;
                    }
                    $Inventory->inventorie = $Inventory->inventorie - $cartItem->product_quntity;
                    $Inventory->save();


                    $cartProduct->delete();
                    $cartItem->save();

                    $data = [];

                    $AppCartProduct = WebOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();
                    $sub_total = [];
                    $total_taxes = [];

                    foreach ($AppCartProduct as $List) {
                        $total_taxes[] += $List->taxes ?? 1;
                        $sub_total[] += $List->sub_total;

                        $data['product'][] = [
                            "product_id" => $List->id,
                            "product_price" => $List->product_price,
                            "product_quntity" => $List->product_quntity,
                            "product_weight" => $List->product_weight,
                            "product_lush" => $List->Product->lush,
                            "taxes" => $List->taxes,
                            "sub_total" => $List->sub_total,
                            "total_amount" => $List->total_amount,
                            "product_name" => $List->Product->product_name,
                            "product_image" => $List->Product->image,

                        ];
                    }
                    $data['cart_Id'] = $cart->cart_id;
                    $data['employee_id'] = $cart->employee_id;

                    $data['cart_sub_total'] = number_format(array_sum($sub_total), 0);
                    $data['cart_taxes'] = number_format(array_sum($total_taxes), 0);
                    $data['cart_total_amount'] = number_format(array_sum($total_taxes) + array_sum($sub_total), 0);

                    $cart->sub_total = $data['cart_sub_total'];
                    $cart->taxes = $data['cart_taxes'];
                    $cart->total_amount = $data['cart_total_amount'];
                    $cart->save();
                    $response = [
                        'success' => true,
                        'data' => $data,
                        'error_flag' => 0,
                        'message' => 'Product Qty Update successfully',
                    ];
                    return response()->json($response, 200);
                } else {

                    $response = [
                        'success' => false,
                        'data' => '',
                        'error_flag' => 1,
                        'message' => 'Product not found',
                    ];
                    return response()->json($response, 404);
                }
            } else {

                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Employee not found',
                ];
                return response()->json($response,);
            }
            $response = [
                'success' => true,
                'error_flag' => 0,
                'message' => 'Product Add in cart successfully',
            ];
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
                'data' => $e,

            ];
            return response()->json($response, 500);
        }
    }

    public function delete_cart($cart_id, $product_id)
    {
        // $delete_cart = WebOrderCart::where('id', $id)->delete();
        // if ($delete_cart) {
        //     return back()->with('success', 'Your Cart Proudect Delete Successfully.');
        // } else {

        //     return back()->with('error', 'Something wrong!');
        // }

        try {
            // $product_id = $request->input('product_id');
            // $cart_id = $request->input('cart_id');

            $cart = Cart::where('id', $cart_id)->first();
            if ($cart != null) {
                $product = WebOrderCart::where('cart_id', $cart->id)->where('id', $product_id)->first();
                if ($product != null) {

                    $product->delete();
                    $count = WebOrderCart::where('cart_id', $cart->id)->count();
                    if ($count == 0) {
                        $cart->delete();
                    } else {
                        $cart->save();
                    }

                    return back()->with('success', 'Product is remove from the cart');
                } else {
                    return back()->with('error', 'Product not found from the cart');
                }
            } else {
                return back()->with('error', 'cart not found!');
            }
            return response()->json($response, 404);
        } catch (\Exception $e) {

            return back()->with('error', 'Something wrong!');
        }
    }


    public function confirm_order(Request $request)
    {
        try {

            // dd($request->all());
            $auth = auth()->user()->id;

            $cart = Cart::where('id', $request->cart_id)->first();
            if ($cart != null) {

                $web_confirm_order = new AppOrder();
                $web_confirm_order->cart_id = $request->cart_id;
                $web_confirm_order->total_text = $request->total_text;
                $web_confirm_order->sub_total = $request->sub_total;
                $web_confirm_order->total = $request->total;
                $web_confirm_order->address_id = $request->address_id;
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
        } catch (\Exception $e) {
            // dd($e);
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred errore Plase try again.');
        }
    }
}
