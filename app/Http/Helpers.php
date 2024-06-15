<?php

use Illuminate\Support\Facades\Response;
use App\Models\AppOrder;
use App\Models\Cart;
use App\Models\AppOrderCart;
use App\Models\automation_history;
use App\Models\Conversion;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Else_;

if (!function_exists('merge')) {
    function merge($arrays)
    {
        $result = [];

        foreach ($arrays as $array) {
            if ($array !== null) {
                if (gettype($array) !== 'string') {
                    foreach ($array as $key => $value) {
                        if (is_integer($key)) {
                            $result[] = $value;
                        } elseif (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                            $result[$key] = merge([$result[$key], $value]);
                        } else {
                            $result[$key] = $value;
                        }
                    }
                } else {
                    $result[count($result)] = $array;
                }
            }
        }

        return join(" ", $result);
    }
}

if (!function_exists('uncamelize')) {
    function uncamelize($camel, $splitter = "_")
    {
        $camel = preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0', preg_replace('/(?!^)[[:upper:]]+/', $splitter . '$0', $camel));
        return strtolower($camel);
    }
}


function generateString()
{
    try {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $string = str_shuffle($pin);
        return $string;
    } catch (Exception $e) {
        Log::error('error : ' . $e->getMessage());
    }
}


function weightInGramsToPrice($weightInGrams, $price_per_gram)
{
    $totalPrice = $price_per_gram * $weightInGrams;
    return $totalPrice;
}

function weightInPriceToGrams($price, $price_per_gram)
{
    $weightInGrams = intval($price / $price_per_gram);
    return $weightInGrams;
}

function weightInKilogramsToPrice($weightInKg, $price_per_gram)
{
    $totalPrice = $price_per_gram * $weightInKg * 1000;
    return $totalPrice;
}

function weightInPriceToKilograms($price, $price_per_gram)
{
    $weightInKg = $price / ($price_per_gram / 1000);
    return $weightInKg / 1000;
}

function addTriggerStock($PId)
{
    $Product = Product::where('id', $PId)->first();
}
function TriggerStock($PId)
{
    $Product = Product::where('id', $PId)->first();

    $existingConversion = Conversion::where('product_one_id', $PId)
        ->where('type', 1)
        ->first();

    if ($existingConversion != null && $Product->getProductIngredient->count() != 0) {

        foreach ($Product->getProductIngredient as $ProductIngredient) {
            $Ingredient = Inventory::where('product_id', $ProductIngredient->ingredient_id)->first();
            $Ingredient->inventorie = $Ingredient->inventorie - ($ProductIngredient->qty * $existingConversion->manufactur_qty);
            $Ingredient->save();
        }

        $Inventory = Inventory::where('product_id', $PId)->first();

        if ($Inventory == null) {
            $Inventory = new Inventory();
            $Inventory->product_id = $PId;
        }
        $Inventory->inventorie = $Inventory->inventorie - $existingConversion->manufactur_qty;
        $Inventory->save();


        // Create automation history
        $automation_history = new automation_history();
        $automation_history->product_id = $Product->id;
        $automation_history->qty = $existingConversion->manufactur_qty;
        $automation_history->type = 1;
        $automation_history->save();

        return;
    }
    $existingConversion = Conversion::where('product_two_id', $PId)
        ->where('type', 0)
        ->first();
    if ($existingConversion != null && $Product->getProductIngredient->count() != 0) {

        foreach ($Product->getProductIngredient as $ProductIngredient) {
            $Ingredient = Inventory::where('product_id', $ProductIngredient->ingredient_id)->first();
            $Ingredient->inventorie = $Ingredient->inventorie - $existingConversion->qty_one;
            $Ingredient->save();
        }

        $Inventory = Inventory::where('product_id', $PId)->first();

        if ($Inventory == null) {
            $Inventory = new Inventory();
            $Inventory->product_id = $PId;
        }
        $Inventory->inventorie = $Inventory->inventorie - $existingConversion->qty_two;
        $Inventory->save();


        // Create automation history
        $automation_history = new automation_history();
        $automation_history->product_id = $Product->id;
        $automation_history->qty = $existingConversion->qty_two;
        $automation_history->type = 0;
        $automation_history->save();

        return;
    }
}
function getOrderReceipt($orderId)
{
    try {
        $order = AppOrder::findOrFail($orderId);
        if ($order == null) {
            return response()->json([
                'success' => false,
                'data' => '',
                'error_flag' => 1,
                'message' => 'Order not found',
            ], 404);
        }

        $cart = Cart::where('id', $order->cart_id)->first();
        if ($cart == null) {
            return response()->json([
                'success' => false,
                'data' => '',
                'error_flag' => 1,
                'message' => 'Order Product not found',
            ], 404);
        }

        $allProducts = AppOrderCart::where('cart_id', $order->cart_id)
            ->orderBy('id', 'DESC')->get()
            ->groupBy('firm_id');


        $Gstproducts = AppOrderCart::where('cart_id', $order->cart_id)
            ->orderBy('gst_p', 'DESC')->get()
            ->groupBy('gst_p');

        if ($allProducts->count() == 0) {
            return response()->json([
                'success' => false,
                'data' => '',
                'error_flag' => 1,
                'message' => 'Order Product not found in Cart',
            ], 404);
        }

        return $allProducts;
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error_flag' => 1,
            'message' => 'An error occurred while processing your request.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

function formatNumber($number)
{
    if (is_int($number) || floor($number) == $number) {
        return $number;  // Return as integer if there's no fractional part
    } else {
        return number_format($number, 3, '.', ',');  // Return with three decimal places
    }
}
