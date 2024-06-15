<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReturnOrderResource;
use App\Models\AdminCustomerModels;
use App\Models\AdminOrderCart;
use App\Models\AppOrder;
use App\Models\AppOrderCart;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReturnOrderController extends Controller
{
    public function returnOrderView(): View
    {
        // $productsList = Product::orderBy('id', 'DESC')->get();
        // $ingredient = Ingredient::orderBy('id', 'DESC')->get();

        return view('admin-pages/order-return/order-return', [
            // 'productsList' => $productsList,
            // 'ingredient' => $ingredient,
            'layout' => 'side-menu'
        ]);
    }

    public function returnOrderAdd(): View
    {
        $AdminCustomer = AdminCustomerModels::orderBy('id', 'DESC')->get();
        $returnOrder = AdminOrderCart::with('Product')->get();
        
        return view('admin-pages/order-return/add-order-return', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'returnOrder' => $returnOrder,
            'layout' => 'side-menu'
        ]);
    }

    public function fetchForReturnOrder( $id)
    {
        try {
            $return_product = AdminOrderCart::findOrFail($id);
            return new ReturnOrderResource($return_product);
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }


    
}
