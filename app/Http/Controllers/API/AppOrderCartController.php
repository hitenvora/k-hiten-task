<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppOrderCart;
use App\Models\Cart;
use App\Models\Ingredient;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppOrderCartController extends Controller
{

    public function addProductCart(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'E_Id' => 'required',
                'product_id' => 'required',
                'product_Price' => 'required',
            ]);
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors(),
                ];
                return response()->json($response, 400);
            }

            $User = User::where('id', $request->E_Id)->first();
            if ($User != null) {
                $cart = Cart::where('employee_id', $request->E_Id)->first();
                $Product = Product::where('id', $request->product_id)->first();
                $product_quntity = $request->input('product_quntity');

                if ($cart != null) {
                    $CartProduct = AppOrderCart::where('cart_Id', $cart->id)->where('product_id', $request->product_id)->where('employee_id', $request->E_Id)->first();

                    if ($CartProduct != null) {

                        if ($CartProduct->Product->lush != 1) {
                            $product_quntity = $product_quntity + $CartProduct->product_quntity;
                        }
                    }
                }
                $product_idInventory = Inventory::where('product_id', $Product->id)->first();
                if ($Product != null) {
                    if ((int)$product_quntity > (int)$product_idInventory->inventorie) {
                        TriggerStock($Product->id);
                    }
                    if (isset($CartProduct) && $CartProduct != null) {
                        $product_idInventory = Inventory::where('product_id', $CartProduct->product_id)->first();
                        $product_idInventory->inventorie = $product_idInventory->inventorie + $CartProduct->product_quntity;

                        $product_idInventory->save();
                        $CartProduct->delete();
                    }
                    if ($cart == null) {
                        for ($cart_Id = 1; $cart_Id <= 50; $cart_Id++) {
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
                            if($key=='GST'){
                                $gst_p = $value ;
                            }
                            $cartItem_gst[$key] = ($request->input('product_Price') * (($value / 100))) * $product_quntity;
                            $taxes = $taxes + $value;
                        }
                    }
                    // $taxe = ($request->input('product_Price') - $Product->text_prize) * $product_quntity;
                    $taxe = ($Product->per_kg_price - $Product->text_prize) * $product_quntity;


                    $cartItem = new AppOrderCart();
                    $cartItem->cart_Id = $cart->id;
                    $cartItem->employee_id = $User->id;
                    $cartItem->product_id = $request->input('product_id');
                    $cartItem->firm_id = $Product->firm_id;
                    $cartItem->gst_p = $gst_p;

                    $cartItem->product_quntity = $product_quntity;

                    $cartItem->product_weight = $request->input('product_Weight');
                    if ($Product->text_prize != 0) {
                        if ($Product->lush != 1) {
                            $cartItem->product_price = round((float)$Product->text_prize, 0);
                            $cartItem->taxes = $taxe;
                        } else {

                            $gsts = 0;
                            foreach ($taxesList as $gst) {
                                foreach ($gst as $key => $value) {
                                    try {
                                        $gsts = (float)$gsts + (float)$value;
                                    } catch (\Throwable $th) {
                                    }
                                }
                            }
                            $text_prize = round((float)$request->input('product_Price') / (($gsts / 100) + 1), 0);
                            $cartItem->product_price = round((float)$$text_prize, 0);
                            $cartItem->taxes = $request->input('product_Price') - $text_prize;
                        }
                    } else {
                        $cartItem->product_price =  $Product->per_kg_price;
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

                    $AppCartProduct = appOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();

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
                    $response = [
                        'success' => true,
                        'data' => $data,
                        'error_flag' => 0,
                        'message' => 'Product Add in cart successfully',
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

    public function getCartProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required',
            'employee_id' => 'required',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }
        $cart_id = $request->cart_id;
        $employee_id = $request->employee_id;

        $User = User::where('id', $employee_id)->first();
        if ($User == null) {
            $response = [
                'success' => false,
                'data' => '',
                'error_flag' => 1,
                'message' => 'Employee not found',
            ];
            return response()->json($response, 404);
        }

        $cart = Cart::where('cart_id', $cart_id)->first();
        if ($cart == null) {
            $response = [
                'success' => false,
                'data' => '',
                'error_flag' => 1,
                'message' => 'Cart not found',
            ];
            return response()->json($response, 404);
        }


        $Oldcarts = Cart::where('employee_id', $employee_id)->orderBy('id', 'DESC')->get();
        foreach ($Oldcarts as $list) {
            $list->employee_id = 0;
            $list->save();
        }
        foreach ($Oldcarts as $list) {
            $OldAppCartProduct = AppOrderCart::where('cart_id', $list->id)->orderBy('id', 'DESC')->get();
            foreach ($OldAppCartProduct as $list) {
                $list->employee_id = 0;
                $list->save();
            }
        }
        $cart = Cart::where('cart_id', $cart_id)->first();
        $cart->employee_id = $employee_id;
        $cart->save();

        $AppCartProduct = AppOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();
        foreach ($AppCartProduct as $list) {
            $list->employee_id = $employee_id;
            $list->save();
        }
        if ($cart != null) {
            $data = [];
            $data['cart_Id'] = $cart->cart_id;
            $data['employee_id'] = $cart->employee_id;
            $data['cart_sub_total'] = $cart->sub_total;
            $data['cart_taxes'] = $cart->taxes;
            $data['cart_total_amount'] = $cart->total_amount;

            $AppCartProduct = AppOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();

            foreach ($AppCartProduct as $List) {
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

            $response = [
                'success' => true,
                'data' => $data,
                'error_flag' => 0,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'success' => false,
            'data' => '',
            'error_flag' => 1,
            'message' => 'cart not found',
        ];
        return response()->json($response, 404);
    }

    public function getActiveEmployeeCartProduct($e_id)
    {
        $employee_id = $e_id;

        $User = User::where('id', $employee_id)->first();
        if ($User == null) {
            $response = [ 
                'success' => false,
                'data' => '',
                'error_flag' => 1,
                'message' => 'Employee not found',
            ];
            return response()->json($response, 404);
        }

        $cart = Cart::where('employee_id', $e_id)->first();

        if ($cart != null) {
            $data = [];
            $data['cart_Id'] = $cart->cart_id;
            $data['employee_id'] = $cart->employee_id;
            $data['cart_sub_total'] = $cart->sub_total;
            $data['cart_taxes'] = $cart->taxes;
            $data['cart_total_amount'] = $cart->total_amount;

            $AppCartProduct = AppOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();

            foreach ($AppCartProduct as $List) {
                $data['product'][] = [
                    "product_id" => $List->id,
                    "product_price" => $List->product_price,
                    "product_quntity" => $List->product_quntity,
                    "taxes" => $List->taxes,
                    "sub_total" => $List->sub_total,
                    "total_amount" => $List->total_amount,

                    "product_name" => $List->Product->product_name,
                    "product_image" => $List->Product->image,

                ];
            }

            $response = [
                'success' => true,
                'data' => $data,
                'error_flag' => 0,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'success' => false,
            'data' => '',
            'error_flag' => 1,
            'message' => 'cart not found',
        ];
        return response()->json($response, 404);
    }
    public function getEmployeeCartProduct($e_id)
    {
        $cart = Cart::where('employee_id', $e_id)->where('cart_id', '!=', 0)->first();
        if ($cart != null) {
            $data = [];

            $AppCartProduct = AppOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();

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
            ];
            return response()->json($response, 200);
        }
        $response = [
            'success' => false,
            'data' => '',
            'error_flag' => 1,
            'message' => 'cart not found',
        ];
        return response()->json($response, 404);
    }

    public function getCartData()
    {
        $data = Cart::where('cart_id', '!=', 0)->orderBy('id', 'DESC')->get();

        $data_array = [];
        foreach ($data as $list) {
            if ($list->AppCustomer != null) {
                $data_array[] = [
                    "cart_Id" => $list->cart_id,
                    "Name" => $list->AppCustomer->first_name,
                    "employee_id" => $list->employee_id,
                    "total_prod" => AppOrderCart::where('cart_id', $list->id)->count(),
                ];
            } else {
                $data_array[] = [
                    "cart_Id" => $list->cart_id,
                    "employee_id" => $list->employee_id,
                    "Name" => '',
                    "total_prod" => AppOrderCart::where('cart_id', $list->id)->count(),
                ];
            }
        }
        if ($data->isNotEmpty()) {
            $response = [
                'success' => true,
                'data' => $data_array,
                'error_flag' => 0,
                'message' => 'Get the all product data successfully',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'data' => '',
                'error_flag' => 1,
                'message' => 'product not found',
            ];
            return response()->json($response, 404);
        }
    }
    public function deleteproduct(Request $request)
    {
        try {
            $product_id = $request->input('product_id');
            $cart_id = $request->input('cart_id');

            $cart = Cart::where('cart_id', $cart_id)->where('cart_id', '!=', 0)->first();
            if ($cart != null) {
                $product =  AppOrderCart::where('cart_id', $cart->id)->where('id', $product_id)->first();
                if ($product != null) {

                    $product->delete();
                    $count = AppOrderCart::where('cart_id', $cart->id)->count();
                    if ($count == 0) {
                        $cart->delete();
                    } else {
                        $cart->save();
                    }

                    $response = [
                        'success' => true,
                        'error_flag' => 0,
                        'message' => 'Product is remove from the cart',
                    ];
                    return response()->json($response, 200);
                } else {
                    $response = [
                        'success' => false,
                        'error_flag' => 1,
                        'message' => 'Product not found from the cart',
                    ];
                    return response()->json($response, 404);
                }
            } else {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'cart not found',
                ];
            }
            return response()->json($response, 404);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function updateQty(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'E_Id' => 'required',
                'product_id' => 'required',
                'product_Price' => 'required',
            ]);

            // Check for validation errors
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors(),
                ];
                return response()->json($response, 400);
            }

            $User = User::where('id', $request->E_Id)->first();
            if ($User != null) {
                $cart = Cart::where('employee_id', $request->E_Id)->first();
                if ($cart == null) {
                    $response = [
                        'success' => false,
                        'data' => '',
                        'error_flag' => 1,
                        'message' => 'Cart not found',
                    ];
                    return response()->json($response, 404);
                }
                $cartProduct = AppOrderCart::where('cart_id', $cart->id)->where('id', $request->product_id)->first();


                if ($cartProduct == null) {
                    $response = [
                        'success' => false,
                        'data' => '',
                        'error_flag' => 1,
                        'message' => 'Product not found in Cart',
                    ];
                    return response()->json($response, 404);
                }

                $product_idInventory = Inventory::where('product_id', $cartProduct->product_id)->first();
                if ($request->input('product_quntity') - $cartProduct->product_quntity > (int)$product_idInventory->inventorie) {
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
                            $cartItem_gst[$key] = ($request->input('product_Price') * (($value / 100))) * $request->input('product_quntity');
                            $taxes = $taxes + $value;
                        }
                    }
                    // $taxe = ($request->input('product_Price') - $Product->text_prize) * $request->input('product_quntity');

                    $taxe = ($Product->per_kg_price - $Product->text_prize) *  $request->input('product_quntity');

                    $cartItem = new AppOrderCart();
                    $cartItem->id = $cartProduct->id;
                    $cartItem->cart_Id = $cart->id;
                    $cartItem->employee_id = $User->id;
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
                                        $gsts = (float)$gsts + (float)$value;
                                    } catch (\Throwable $th) {
                                    }
                                }
                            }
                            $text_prize = round((float)$request->input('product_Price') / (($gsts / 100) + 1), 0);
                            $cartItem->product_price = $text_prize;
                            $cartItem->taxes = $request->input('product_Price') - $text_prize;
                        }
                    } else {
                        $cartItem->product_price =  $Product->per_kg_price;
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

                    $AppCartProduct = AppOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();
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
}
