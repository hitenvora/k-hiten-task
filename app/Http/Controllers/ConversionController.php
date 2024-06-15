<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversion;
use App\Models\manufacturing;

use App\Models\Inventory;
use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Illuminate\View\View;

class ConversionController extends Controller
{
    public function conversionList(): View
    {

        $conversion = Conversion::orderBy('id', 'DESC')->get();

        return view('admin-pages/conversion/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'conversion' => $conversion,
            'layout' => 'side-menu'
        ]);
    }

    public function addConversion(): View
    {
        $Product = Product::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('admin-pages/conversion/add', [
            'Product' => $Product,
            'layout' => 'side-menu'
        ]);
    }
    public function saveConversion(Request $request)
    {
        // // Create a new Conversion instance
        // $conversion = new Conversion;
        // // Assign values from the request to the Conversion model properties
        // $conversion->product_one_id = $request->product_one_id;
        // $conversion->product_two_id = $request->product_two_id;
        // $conversion->qty_one = $request->qty_one;
        // $conversion->qty_two = $request->qty_two;
        // $conversion->type = 0;

        // // Save the Conversion model to the database
        // $conversion->save();
        try{
            // Check if product_one_id and product_two_id are the same
            if ($request->product_one_id === $request->product_two_id) {
                return response()->json(['error' => 'Product IDs cannot be the same'], 400);
            }

            // Check if a similar conversion already exists in the database
            $existingConversion = Conversion::where('product_one_id', $request->product_one_id)
                ->where('product_two_id', $request->product_two_id)
                ->where('type', 0)
                ->first();

            // If a similar conversion doesn't exist, proceed with saving
            if (!$existingConversion) {
                // Create a new Conversion instance
                $conversion = new Conversion;
                // Assign values from the request to the Conversion model properties
                $conversion->product_one_id = $request->product_one_id;
                $conversion->product_two_id = $request->product_two_id;
                $conversion->qty_one = $request->qty_one;
                $conversion->qty_two = $request->qty_two;
                $conversion->threshold_qty = $request->threshold_qty;
                $conversion->manufactur_qty = $request->manufactur_qty;
                $conversion->type = 0;

                // Save the Conversion model to the database
                $conversion->save();
                // return response()->json(['message' => 'Conversion saved successfully'], 200);

            } else {
                // If a similar conversion exists, return an error message
                return response()->json(['error' => 'Conversion with these product IDs already exists'], 400);
            }
            return redirect()->route('conversionList.list')->with('success','add One-Top-Many conversion Successfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }

        
        // If product IDs are the same, it's a self-conversion
        // if ($request->product_one_id == $request->product_two_id) {
        //     $inventory = Inventory::where('product_id', $conversion->product_one_id)->first();

        //     if ($inventory) {
        //         // Subtract qty_one from inventory and add qty_two to it
        //         $inventory->inventorie += ($request->qty_two - $request->qty_one);
        //         $inventory->save();
        //     }
        // } else {
        //     // Retrieve the inventory associated with product_one_id
        //     $inventory = Inventory::where('product_id', $conversion->product_one_id)->first();
        //     $inventory_two = Inventory::where('product_id', $conversion->product_two_id)->first();

        //     if ($inventory) {
        //         $inventory->inventorie -= $request->qty_one; 
        //         $inventory->save();
        //     } 
        //     if($inventory_two){
        //         $inventory_two->inventorie += $request->qty_two; 
        //         $inventory_two->save();
        //     }
        // }

        // Redirect the user to the conversion list page after saving
    }


    public function editConversion($id): View
    {
        $conversion = Conversion::findOrFail($id);
        $Product = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('admin-pages/conversion/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'conversion' => $conversion,
            'Product' => $Product,
            'layout' => 'side-menu'
        ]);
    }
    public function updateConversion(Request $request, $id)
    {
        try{
            // dd($request->all());
            if ($request->product_one_id === $request->product_two_id) {
                return response()->json(['error' => ''], 400);
            }

            // Check if a similar conversion already exists in the database
            $existingConversion = Conversion::where('product_one_id', $request->product_one_id)
                ->where('product_two_id', $request->product_two_id)
                ->first();

            // If a similar conversion doesn't exist, proceed with saving
            if (!$existingConversion) {
                $conversion = Conversion::findOrFail($id);
                $conversion->product_one_id = $request->product_one_id;
                $conversion->product_two_id = $request->product_two_id;
                $conversion->qty_one = $request->qty_one;
                $conversion->qty_two = $request->qty_two;
                $conversion->threshold_qty = $request->threshold_qty;
                $conversion->manufactur_qty = $request->manufactur_qty;
                // $conversion->volume = $request->volume;
                $conversion->type = 0;
                $conversion->save();
            } else {
                $existingConversion->product_one_id = $request->product_one_id;
                $existingConversion->product_two_id = $request->product_two_id;
                $existingConversion->qty_one = $request->qty_one;
                $existingConversion->qty_two = $request->qty_two;
                $existingConversion->threshold_qty = $request->threshold_qty;
                $existingConversion->manufactur_qty = $request->manufactur_qty;
                // $existingConversion->volume = $request->volume;
                $existingConversion->type = 0;
                $existingConversion->save();
            }
            return redirect()->route('conversionList.list')->with('success','add One-Top-Many conversion Successfully!');
    } catch (ValidationException $e) {
        return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
    }
    }
}
