<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\OrderAddress;
use App\Models\OrderPincode;
use App\Models\Product;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DeliveryController extends Controller
{
    public function deliveryView(): View
    {


        $cart_product = null;
        $Cart = Cart::where('employee_id', Auth::user()->id)->first();
        if ($Cart != null) {
            $cart_product = WebOrderCart::where('cart_id', $Cart->id)->with('Product')->get();
            // Assuming $cart_products is an array or collection of products in the user's cart
            $cart_product_ids = $cart_product->pluck('product_id')->toArray();

            // Retrieve the subcategories of products in the cart
            $subcategories = Product::whereIn('id', $cart_product_ids)->pluck('sub_category')->toArray();
            // Retrieve related products based on the subcategories
            $related_products = Product::whereIn('sub_category', $subcategories)
                ->whereNotIn('id', $cart_product_ids) // Exclude products already in the cart
                ->take(5) // Limit the number of related products to display
                ->get();
        } else {
            $related_products = Product::where('popular', 1)->get();

        }

        $address_show = OrderAddress::where('user_id', auth()->user()->id)->firstOrFail();


        return view('front-pages/delivery', [
            'cart_product' => $cart_product,
            'related_products' => $related_products,
            'address_show' => $address_show,

        ]);
    }




    public function addProductCart(Request $request)
    {
        try {

            $validator = validator::make($request->all(), [
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
                    $CartProduct = WebOrderCart::where('cart_Id', $cart->id)->where('product_id', $request->product_id)->where('employee_id', $request->E_Id)->first();

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
                            if ($key == 'GST') {
                                $gst_p = $value;
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
                            $text_prize = round((float) $request->input('product_Price') / (($gsts / 100) + 1), 3);
                            $cartItem->product_price = $text_prize;
                            $cartItem->taxes = $request->input('product_Price') - $text_prize;
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
                return response()->json($response, );
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


    public function checkAvailability(Request $request)
    {
        $pincode = $request->input('pincode');
        $available = OrderPincode::where('pincode', $pincode)->exists();
        return response()->json(['available' => $available]);
    }

}
