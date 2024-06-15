<?php

namespace App\Http\Controllers;

use App\Models\OrderPincode;
use Illuminate\Http\Request;
use Illuminate\View\View;


class OrderPincodeController extends Controller
{
    public function add_order_pincode(): View
    {

        return view('admin-pages/order-pincode/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ]);
    }
    public function order_pincode_list()
    {
        $order_pincodeList = OrderPincode::all();
        return view('admin-pages/order-pincode/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'order_pincodeList' => $order_pincodeList,
            'layout' => 'side-menu'
        ]);
    }
    public function save_order_pincode(Request $request)
    {
        // dd($request->all());
        try {
            $validated = $request->validate([
                'pincode' => 'required',

            ]);

            $saveaddorder_pincode = new OrderPincode();
            $saveaddorder_pincode->pincode = $request->pincode;


            $saveaddorder_pincode->save();

            return redirect()->route('order_pincode.list')->with('success', 'order Pincode  saved successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions

            return redirect()->back()->with('error', 'An error occurred while saving the order Pincode data.');
        }
    }
    public function edit_order_pincode($id)
    {


        $edit_order_pincode = OrderPincode::findOrFail($id);
        // dd($edit_order_pincode);
        return view('admin-pages/order-pincode/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'edit_order_pincode' => $edit_order_pincode,
            'layout' => 'side-menu'
        ]);
    }
    public function update_order_pincode(Request $request, $id)
    {
        try {
            // $validated = $request->validate([
            //     'pincode' => 'required|max:255',
            //     'message' => 'required|max:255',

            // ]);
            // Find the record by ID or create a new instance if not found
            $data = OrderPincode::findOrFail($id);
            $data->pincode = $request->pincode;


        

            $data->updated_at = now();
            $data->save();
            return redirect()->route('order_pincode.list')->with('success', 'order Pincode  Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }


    public function delete_order_pincode($id)
    {
        try {
            $delete_order_pincode = OrderPincode::findOrFail($id);
            $delete_order_pincode->delete();

            return redirect()->route('order_pincode.list')->with('success', 'order Pincode  Updated successfully!');
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error Delete data: ' . $e->getMessage()]);
        }
    }

}
