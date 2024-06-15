<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockInHand;
use Illuminate\Http\Request;
use Illuminate\View\View;


class StockInHandController extends Controller
{
    public function addStock_in_hand(): View
    {
        $productsList = Product::orderBy('id', 'DESC')->get();
        // $ingredient = Ingredient::orderBy('id', 'DESC')->get();

        return view('admin-pages/stock-in-hand/add-stock-in-hand', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'productsList' => $productsList,
            // 'ingredient' => $ingredient,
            'layout' => 'side-menu'
        ]);
    }
    public function stock_in_handList()
    {
        $stock_in_handList = StockInHand::with('GetProduct')->get();

        return view('admin-pages/stock-in-hand/list-stock-in-hand', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'stock_in_handList' => $stock_in_handList,
            'layout' => 'side-menu'
        ]);
    }


    public function saveStock_in_hand(Request $request)
    {
        try {
            // $validated = $request->validate([
               
            // ]);

            $customer = new StockInHand();
            $customer->product_id = $request->product_id;
            $customer->price = $request->price;
            $customer->qty_in_hand = $request->qty_in_hand;
            $customer->qty_in_sold = $request->qty_in_sold;
            $customer->inventry_value = $request->inventry_value;
            $customer->sale_value = $request->sale_value;
            $customer->avalible_stock = $request->avalible_stock;
            $customer->save();

            return redirect()->route('stock-in-hand.list')->with('success', 'Stock In Hand saved successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while saving the Stock In Hand data.');
        }
    }
    public function editStock_in_hand($id)
    {
        $productsList = Product::orderBy('id', 'DESC')->get();
        // $ingredientList = Ingredient::orderBy('id', 'DESC')->get();

        $editPerchParty = StockInHand::findOrFail($id);
        return view('admin-pages/stock-in-hand/edit-stock-in-hand', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'editPerchParty' => $editPerchParty,
            'productsList' => $productsList,
            // 'ingredientList' => $ingredientList,
            'layout' => 'side-menu'
        ]);
    }
    public function updateStock_in_hand(Request $request, $id)
    {
        try {
            // $validated = $request->validate([
            //     'name' => 'required|max:255',
            //     'company_name' => 'required|max:255',
            //     'gst_number' => 'required|max:255',
            //     'mobail_number' => 'required|max:10', // Set maximum length to 10 characters
            //     'mail' => 'required|email|unique:perch_parties,mail,' . $id,
            //     'address' => 'required|max:255',
            //     'products' => 'required|max:255',
            //     // 'ingredient' => 'required|max:255',
            //     'state' => 'required|max:255',
            //     'citie' => 'required|max:255',
            //     'zip_cod' => 'required|max:255',
            // ]);
            // Find the record by ID or create a new instance if not found
            $data = StockInHand::findOrFail($id);
            $data->product_id = $request->product_id;
            $data->price = $request->price;
            $data->qty_in_hand = $request->qty_in_hand;
            $data->qty_in_sold = $request->qty_in_sold;
            $data->inventry_value = $request->inventry_value;
            $data->sale_value = $request->sale_value;
            $data->avalible_stock = $request->avalible_stock;
            $data->updated_at = now();
            $data->save();
            return redirect()->route('stock-in-hand.list')->with('success', 'Stock In Hand Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }



    public function status($id)
    {
        $Product = StockInHand::findOrFail($id);

        $Product->status = $Product->status;
        if ($Product->status == '0') {
            $Product->status = '1';
        } elseif ($Product->status == '1') {
            $Product->status = '0';
        }
        $Product->save();
        return redirect()->route('stock-in-hand.list');
    }


}
