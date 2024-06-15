<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Ingredient;
use App\Models\PerchParty;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PerchPartyController extends Controller
{
    public function addPerchParty(): View
    {
        $productsList = Product::orderBy('id', 'DESC')->get();
        $ingredient = Ingredient::orderBy('id', 'DESC')->get();

        return view('admin-pages/PerchParty/addCustomer', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'productsList' => $productsList,
            'ingredient' => $ingredient,
            'layout' => 'side-menu'
        ]);
    }
    public function PerchPartyList()
    {
        $customerData = PerchParty::all();
        return view('admin-pages/PerchParty/customerList', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'customerData' => $customerData,
            'layout' => 'side-menu'
        ]);
    }
    public function savePerchParty(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'company_name' => 'required|max:255',
                'gst_number' => 'required|max:255',
                'mobail_number' => 'required|max:10', // Set maximum length to 10 characters
                'mail' => 'required|email|unique:perch_parties,mail',
                'address' => 'required|max:255',
                'products' => 'required|max:255',
                // 'ingredient' => 'required|max:255',
                'state' => 'required|max:255',
                'citie' => 'required|max:255',
                'zip_cod' => 'required|max:255',
            ]);

            $customer = new PerchParty();
            $customer->name = $request->name;
            $customer->company_name = $request->company_name;
            $customer->gst_number = $request->gst_number;
            $customer->mobail_number = $request->mobail_number;
            $customer->mail = $request->mail;
            $customer->address = $request->address;
            $customer->products = implode(',', $request->products);
            // $customer->ingredient = implode(',', $request->ingredient);
            $customer->state = $request->state;
            $customer->citie = $request->citie;
            $customer->zip_cod = $request->zip_cod;
            $customer->save();

            return redirect()->route('admin.perchparty.list')->with('success', 'Customer data saved successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while saving the customer data.');
        }
    }
    public function editPerchParty($id)
    {
        $productsList = Product::orderBy('id', 'DESC')->get();
        $ingredientList = Ingredient::orderBy('id', 'DESC')->get();
        
        $customer = PerchParty::findOrFail($id);
        return view('admin-pages/PerchParty/updateCustomer', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'customer' => $customer,
            'productsList' => $productsList,
            'ingredientList' => $ingredientList,
            'layout' => 'side-menu'
        ]);
    }
    public function updatePerchParty(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'company_name' => 'required|max:255',
                'gst_number' => 'required|max:255',
                'mobail_number' => 'required|max:10', // Set maximum length to 10 characters
                'mail' => 'required|email|unique:perch_parties,mail,' . $id,
                'address' => 'required|max:255',
                'products' => 'required|max:255',
                // 'ingredient' => 'required|max:255',
                'state' => 'required|max:255',
                'citie' => 'required|max:255',
                'zip_cod' => 'required|max:255',
            ]);
            // Find the record by ID or create a new instance if not found
            $data = PerchParty::findOrFail($id);
            $data->name = $request->name;
            $data->company_name = $request->company_name;
            $data->gst_number = $request->gst_number;
            $data->mobail_number = $request->mobail_number;
            $data->mail = $request->mail;
            $data->address = $request->address;
            $data->products = implode(',', $request->products);
            // $data->ingredient = implode(',', $request->ingredient);
            $data->state = $request->state;
            $data->citie = $request->citie;
            $data->zip_cod = $request->zip_cod;
            $data->updated_at = now();
            $data->save();
            return redirect()->route('admin.perchparty.list')->with('success', 'Customer data Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }


    public function showEntry($id)
{
    // Retrieve all entries for the given party ID
        $entries = Entry::where('partie_id', $id)->get();

    // Calculate cumulative balances for each party ID
    $cumulativeBalances = [];
        $cumulativeBalance = 0;
    foreach ($entries as $entry) {
        $cumulativeBalance += $entry->rupee;
        $cumulativeBalances[$entry->id] = $cumulativeBalance;
        }

    // Pass data to the view
    return view('admin-pages.PerchParty.EntryReport', [
        'entries' => $entries,
        'cumulativeBalances' => $cumulativeBalances,
        'layout' => 'side-menu'
    ]);
}



}
