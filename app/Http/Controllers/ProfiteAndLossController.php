<?php

namespace App\Http\Controllers;

use App\Models\ProfiteAndLoss;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ProfiteAndLossController extends Controller
{
    public function addProfile_loss(): View
    {
        // $productsList = Product::orderBy('id', 'DESC')->get();
        // $ingredient = Ingredient::orderBy('id', 'DESC')->get();

        return view('admin-pages/profit-loss/add-profit-loss', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            // 'productsList' => $productsList,
            // 'ingredient' => $ingredient,
            'layout' => 'side-menu'
        ]);
    }
    public function Profile_lossList()
    {
        $Profile_lossList = ProfiteAndLoss::all();

        return view('admin-pages/profit-loss/list-profit-loss', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'Profile_lossList' => $Profile_lossList,
            'layout' => 'side-menu'
        ]);
    }


    public function saveProfile_loss(Request $request)
    {
        try {
            // $validated = $request->validate([

            // ]);

            $customer = new ProfiteAndLoss();
            $customer->amount = $request->amount;
            $customer->profilt_lose = $request->profilt_lose;
            $customer->description = $request->description;
            $customer->save();

            return redirect()->route('profite-loss.list')->with('success', 'Profite-Loss saved successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while saving the Profite-Loss data.');
        }
    }
    public function editProfile_loss($id)
    {
        // $productsList = Profit::orderBy('id', 'DESC')->get();
        // $ingredientList = Ingredient::orderBy('id', 'DESC')->get();

        $editProfile_loss = ProfiteAndLoss::findOrFail($id);
        return view('admin-pages/profit-loss/edit-profit-loss', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'editProfile_loss' => $editProfile_loss,
            // 'productsList' => $productsList,
            // 'ingredientList' => $ingredientList,
            'layout' => 'side-menu'
        ]);
    }
    public function updateProfile_loss(Request $request, $id)
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
            $data = ProfiteAndLoss::findOrFail($id);
            $data->amount = $request->amount;
            $data->profilt_lose = $request->profilt_lose;
            $data->description = $request->description;
            $data->updated_at = now();
            $data->save();
            return redirect()->route('profite-loss.list')->with('success', 'Profite-Loss Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }



    public function status($id)
    {
        $Product = ProfiteAndLoss::findOrFail($id);

        $Product->status = $Product->status;
        if ($Product->status == '0') {
            $Product->status = '1';
        } elseif ($Product->status == '1') {
            $Product->status = '0';
        }
        $Product->save();
        return redirect()->route('profite-loss.list');
    }


}
