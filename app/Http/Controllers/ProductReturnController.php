<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReturnProductResource;
use App\Models\AdminCustomerModels;
use App\Models\AppOrder;
use App\Models\AppOrderCart;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ReturnProduct;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ProductReturnController extends Controller
{
    public function returnProductView(): View
    {
        // $productsList = Product::orderBy('id', 'DESC')->get();
        // $ingredient = Ingredient::orderBy('id', 'DESC')->get();

        return view('admin-pages/product-return/product-return', [
            // 'productsList' => $productsList,
            // 'ingredient' => $ingredient,
            'layout' => 'side-menu'
        ]);
    }


    public function returnProductAdd($id): View
    {
        $AdminCustomer = AdminCustomerModels::orderBy('id', 'DESC')->get();
        $AppOrderCart = AppOrderCart::with('Product')->get();

        // $purcehseProductShow = AdminOrderCart::where('app_orders_id', $id)->get();
        // $productShow 

        $Order = AppOrder::findOrFail($id);

        return view('admin-pages/product-return/add-product-return', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'AppOrderCart' => $AppOrderCart,
            'Order' => $Order,
            'layout' => 'side-menu'
        ]);
    }

    public function fetchProductForReturnOrder($id)
    {
        try {
            $return_product = AppOrderCart::findOrFail($id);
            return new ReturnProductResource($return_product);
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }

    public function ProdcutReturnSubmit(Request $request)
    {
        try {


            // dd($request->all());    
            // die;


            // $productId = $request->product;
            //  $subtotal = $request->sub_total;

            // $product = AppOrderCart::find($productId);

            // $productId = $request->input('product');

            // Fetch the new sub_total from the request
            $newSubTotal = $request->sub_total;
            $newTotal = $request->final_amount;



            // Find the AppOrderCart record using the productId
            foreach ($request->product as $productId) {
                $product = AppOrderCart::findOrFail($productId);

                // Check if the product exists
                if ($product) {
                    // Calculate the difference between the existing sub_total and the new sub_total
                    $difference_SubTotal = $product->sub_total - $newSubTotal;
                    $difference_Total = $product->total_amount - $newTotal;

                    // Update the sub_total by subtracting the difference
                    $product->sub_total = $difference_SubTotal;
                    $product->total_amount = $difference_Total;
                    $product->return_product = "1";

                    // Save the changes to the database
                    $product->save();


                    $return_product = new ReturnProduct();
                    $return_product->product_id = $productId;
                    $return_product->save();

                    return redirect()->route('app.order.list');
                    //     return response()->json(['success' => 'Sub total updated successfully']);
                    // } else {
                    // Handle the case where the product does not exist
                    // return response()->json(['error' => 'Product not found'], 404);
                }

                $User = User::where('id', $request->E_Id)->first();
                if ($User != null) {
                    $cart = Cart::where('employee_id', $request->E_Id)->first();
                    $Product = Product::where('id', $request->product_id)->first();
                    $product_quntity = $request->input('product_quntity');

                    if ($cart != null) {
                        $CartProduct = AppOrderCart::where('cart_Id', $cart->id)->where('product_id', $request->product_id)->where('employee_id', $request->E_Id)->first();

                        if ($CartProduct != null) {
                            // $cart->sub_total = $cart->sub_total - $CartProduct->sub_total;
                            // $cart->taxes = $cart->taxes - $CartProduct->taxes;
                            // $cart->total_amount = $cart->total_amount - $CartProduct->total_amount;
                            // $cart->save();

                            if ($CartProduct->Product->lush != 1) {
                                $product_quntity = $product_quntity + $CartProduct->product_quntity;
                            }
                        }
                    }
                    $product_idInventory = Inventory::where('product_id', $Product->id)->first();
                    // dd((int)$product_idInventory->inventorie < 0 ,(int)$product_idInventory->inventorie );
                    if ($Product != null) {
                        // if((int)$product_idInventory->inventorie <= 0 ){
                        //     $response = [
                        //         'success' => false,
                        //         'data' => '',
                        //         'error_flag' => 1,
                        //         'message' => 'product not available',
                        //     ];
                        //     return response()->json($response, 404);
                        // }
                        if ((int)$product_quntity > (int)$product_idInventory->inventorie) {
                            TriggerStock($Product->id);
                            // $response = [
                            //     'success' => false,
                            //     'data' => '',
                            //     'error_flag' => 1,
                            //     'message' => 'product not available',
                            // ];
                            // return response()->json($response, 404);
                        }
                        // dd((int)$product_quntity > (int)$product_idInventory->inventorie ,(int)$product_quntity , (int)$product_idInventory->inventorie ,1>2);
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
                                $cartItem_gst[$key] = ($request->input('product_Price') * (($value / 100))) * $product_quntity;
                                $taxes = $taxes + $value;
                            }
                        }
                        // dd($taxesList,$gst,$taxes,$key,$cartItem_gst);
                        $taxe = ($request->input('product_Price') - $Product->text_prize) * $product_quntity;

                        // $Onetaxe = ($request->input('product_Price') * (($taxes / 100)));
                        // $taxe = $Onetaxe * $product_quntity;

                        $cartItem =  AppOrderCart::findOrFail($id);
                        $cartItem->cart_Id = $cart->id;
                        $cartItem->employee_id = $User->id;
                        $cartItem->product_id = $request->input('product_id');
                        $cartItem->firm_id = $Product->firm_id;

                        $cartItem->product_quntity = $product_quntity;

                        $cartItem->product_weight = $request->input('product_Weight');
                        $cartItem->product_price = $request->input('product_Price');
                        $cartItem->taxes = $taxe;
                        $cartItem->gst = json_encode($cartItem_gst);

                        $cartItem->sub_total = $cartItem->product_price * $cartItem->product_quntity;
                        $cartItem->total_amount = $cartItem->sub_total + $cartItem->taxes;
                        $cartItem->save();

                        $Inventory = Inventory::where('product_id', $cartItem->product_id)->first();

                        if ($Inventory == null) {
                            $Inventory = new Inventory();
                            $Inventory->product_id = $cartItem->product_id;
                        }
                        $Inventory->inventorie = $Inventory->inventorie - $cartItem->product_quntity;
                        $Inventory->save();

                        // if ($Product->getProductIngredient->count() != 0) {

                        //     foreach ($Product->getProductIngredient as $ProductIngredient) {

                        //         // $Ingredient = Ingredient::where('id', $ProductIngredient->ingredient_id)->first();
                        //         // $Ingredient->qty = $Ingredient->qty - $ProductIngredient->qty;
                        //         // $Ingredient->save();

                        //         // $Ingredient = Ingredient::where('id', $ProductIngredient->ingredient_id)->first();
                        //         $Ingredient = Inventory::where('product_id', $ProductIngredient->ingredient_id)->first();
                        //         $Ingredient->inventorie = $Ingredient->inventorie - ($ProductIngredient->qty * $product_quntity);
                        //         $Ingredient->save();
                        //     }
                        // }

                        // $cart->sub_total = $cart->sub_total + $cartItem->sub_total;
                        // $cart->taxes = $cart->taxes + $taxe;
                        // $cart->total_amount = $taxes + $cartItem->sub_total;
                        // $cart->save();

                        $data = [];
                        $data['cart_Id'] = $cart->cart_id;
                        $data['employee_id'] = $cart->employee_id;
                        $data['cart_sub_total'] = $cart->sub_total;
                        $data['cart_taxes'] = $cart->taxes;
                        $data['cart_total_amount'] = $cart->total_amount;

                        $AppCartProduct = appOrderCart::where('cart_id', $cart->id)->orderBy('id', 'DESC')->get();

                        // dd($AppCartProduct);
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
            }
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
