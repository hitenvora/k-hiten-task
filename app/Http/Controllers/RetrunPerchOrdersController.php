<?php

namespace App\Http\Controllers;

use App\Models\RetrunPerchOrders;
use Illuminate\Http\Request;

use Illuminate\Contracts\View\View;

class RetrunPerchOrdersController extends Controller
{
    public function perchOrdersRetrunView(): View
    {
        // $productsList = Product::orderBy('id', 'DESC')->get();
        // $ingredient = Ingredient::orderBy('id', 'DESC')->get();

        return view('admin-pages/perch-orders-retrun/perch-orders-retrun', [
            // 'productsList' => $productsList,
            // 'ingredient' => $ingredient,
            'layout' => 'side-menu'
        ]);
    }

    public function perchOrdersRetrunAdd(): View
    {
        $AdminCustomer = AdminCustomerModels::orderBy('id', 'DESC')->get();
        $returnOrder = AppOrder::with('Product')->get();

        return view('admin-pages/perch-orders-retrun/add-perch-orders-retrun', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'AdminCustomer' => $AdminCustomer,
            'returnOrder' => $returnOrder,
            'layout' => 'side-menu'
        ]);
}
}