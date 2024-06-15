<?php

namespace App\Http\Controllers;

use App\Models\inventories;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class inventoryController extends Controller
{
    public function addOpeningStock(): View
    {
        $Products = Product::orderBy('id', 'DESC')->get();

        return view('admin-pages/inventory/addOpeningStock', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            // 'conversion' => $conversion,
            'Products' => $Products,
            'layout' => 'side-menu'
        ]);
    }

    public function saveOpeingStockData(Request $request)
    {
        foreach ($request->opening_stock as $productId => $stock) {
            // $inventoriesProducts = inventories::orderBy('product_id', 'productId')->first();
            $inventoriesProducts = inventories::orderBy('product_id', 'DESC')->first();
            if ($inventoriesProducts != null) {
                inventories::updateOrCreate(
                    ['product_id' => $productId],
                    ['opening_stock' => $stock]
                );
            } else {
                $inventories = new inventories();
                $inventories->product_id = $productId;
                $inventories->opening_stock = $request->opening_stock;
                $inventories->save();
            }
        }

        return redirect()->route('inventory.list')->with('success', 'Open Stock Added Successfully!');
    }
}
