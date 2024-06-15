<?php

namespace App\Http\Controllers;

use App\Models\AppOrder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebController extends Controller
{
    public function webOrder(): View
    {

        $web_order = AppOrder::where('type', '1')->orderBy('id', 'desc')->get();
        
        return view('admin-pages/web-order/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu',
            'web_order' => $web_order
        ]);
    }

    public function editWeborder($id)
    
    {


        $editWeborder = AppOrder::findOrFail($id);
        // dd($editWeborder);
        return view('admin-pages/web-order/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'editWeborder' => $editWeborder,
            'layout' => 'side-menu'
        ]);
    }



    public function updateWeborder(Request $request, $id)
    {
        try {
      
            // Find the record by ID or create a new instance if not found
            $data = AppOrder::findOrFail($id);
            $data->ship_to_name = $request->ship_to_name;
            $data->expected_delivery_date = $request->expected_delivery_date;
            $data->is_delivery = $request->is_delivery;
            $data->updated_at = now();
            $data->save();
            return redirect()->route('weborder.list')->with('success', 'Web Order  Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }



}
