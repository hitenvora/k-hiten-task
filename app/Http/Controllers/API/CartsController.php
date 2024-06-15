<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Product;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
        return CartResource::collection($carts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $cart = new Cart;
        $cart->employee_id = $request->input('employee_id');
        $cart->cart_id = $request->input('cart_id');
        $cart->sub_total = $request->input('sub_total');
        $cart->taxes = $request->input('taxes');
        $cart->total_amount = $request->input('total_amount');
        $cart->save();

        return response()->json($cart, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::findOrFail($id);
        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CartRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->employee_id = $request->input('employee_id');
        $cart->cart_id = $request->input('cart_id');
        $cart->sub_total = $request->input('sub_total');
        $cart->taxes = $request->input('taxes');
        $cart->total_amount = $request->input('total_amount');
        $cart->save();

        return response()->json($cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json(null, 204);
    }


    // public function cart(Request $Request)
    // {
    //     $product = Product::findOrFail($Request->productId);
    //     if ($Request->Price != null && $Request->Price >= $product->per_kg_price) {
    //         $response = [
    //             'price' => $Request->Price,
    //             'kg' => ($Request->Price / $product->per_kg_price),
    //         ];
    //         return response()->json($response, 200);
    //     } if($Request->Price != null && $Request->Price <= $product->per_kg_price) {
    //         $response = [
    //             'price' => $Request->Price,
    //             'gram' => ($Request->Price / $product->per_gram_price),
    //         ];
    //         return response()->json($response, 200);
    //     }
    //     if ($Request->kg != null || $Request->grams != null) {
    //         if ($Request->kg != null) {
    //             $response = [
    //                 'price' => ($Request->kg * $product->per_kg_price),
    //                 'kg' => $Request->kg,
    //             ];
    //             return response()->json($response, 200);
    //         } else {
    //             $response = [
    //                 'price' => ($Request->grams * $product->per_gram_price),
    //                 'grams' => $Request->grams,
    //             ];
    //             return response()->json($response, 200);
    //         }
    //     } else {
    //         $response = [
    //             'price' => ($Request->grams * $product->per_gram_price),
    //             'grams' => $Request->grams,
    //         ];
    //         return response()->json($response, 200);
    //     }
    // }

    public function cart(Request $Request)
    {
        $product = Product::findOrFail($Request->productId);

        if ($Request->kg != null) {
            $price = weightInKilogramsToPrice($Request->kg, $product->per_gram_price);
            $price = formatNumber($price);

            $response = [
                'price' => $price,
                'kg' => $Request->kg,
            ];
            return response()->json($response, 200);
        } else {
            $kg = weightInPriceToKilograms($Request->Price, $product->per_kg_price);
            $kg = formatNumber($kg);

            $response = [
                'price' => $Request->Price,
                'kg' => $kg,
            ];
            return response()->json($response, 200);
        }

        if ($Request->grams != null) {
            $price = weightInGramsToPrice($Request->grams, $product->per_gram_price);
            $price = formatNumber($price);

            $response = [
                'price' => $price,
                'grams' => $Request->grams,
            ];
            return response()->json($response, 200);
        } else {
            $grams = weightInPriceToGrams($Request->Price, $product->per_gram_price);
            $grams = formatNumber($grams);

            $response = [
                'price' => $Request->Price,
                'grams' => $grams,
            ];
            return response()->json($response, 200);
        }
    }
}
