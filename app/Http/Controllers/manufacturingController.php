<?php

namespace App\Http\Controllers;

use App\Models\automation_history;
use App\Models\Conversion;
use App\Models\Inventory;
use App\Models\manufacturing;
use App\Models\productIngredient;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class manufacturingController extends Controller
{
    public function manufacturingList()
    {
        $manufacturing = manufacturing::get();
        return view(
            'manufacturing.manufacturingList',
            ['manufacturing' => $manufacturing]
        );
    }

//Automation history
    public function automationHistoryList()
    {
        $automationHistory = automation_history::get();
        return view(
            'manufacturing.automationHistoryList',
            ['automationHistory' => $automationHistory]
        );
    }
    public function addManufacturing()
    {
        $Product = productIngredient::select('product_ingredien.*', 'products.product_name as product_name')
            ->leftJoin('products', 'product_ingredien.product_id', '=', 'products.id')
            ->orderBy('product_ingredien.id', 'DESC')
            ->get()
            ->groupBy('product_id');
        $conversionProudct = Conversion::get();
        return view('manufacturing.addManufacturing', [
            'Product' => $Product,
            'conversionProudct' => $conversionProudct,
        ]);
    }
    public function savemanufacturing(Request $request)
    {
        try{
            // Retrieve the inventory associated with product_one_id
            $conversion = Conversion::findOrFail($request->id);
            $inventory = Inventory::where('product_id', $conversion->product_one_id)->first();
            $inventory_two = Inventory::where('product_id', $conversion->product_two_id)->first();
            // dd($request->all(),$conversion,$inventory,$inventory_two);

            if ($inventory) {
                $inventory->inventorie -= $conversion->qty_one;
                $inventory->save();
            }
            if ($inventory_two) {
                $inventory_two->inventorie += $conversion->qty_two;
                $inventory_two->save();
            }

            $manufacturing = new manufacturing();
            $manufacturing->conversion_id = $conversion->id;
            $manufacturing->product_one_id = $conversion->product_one_id;
            $manufacturing->product_two_id = $conversion->product_two_id;
            $manufacturing->qty = $conversion->qty_two;
            $manufacturing->save();
            return redirect()->route('inventory.list')->with('success','One-to-Many Converstion succesfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }
}
