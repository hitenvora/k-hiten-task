<?php

namespace App\Http\Controllers;

use App\Models\BankDetails;
use Illuminate\Http\Request;
use Illuminate\View\View;


class BankDetailsController extends Controller
{
    public function addBankDetails(): View
    {
      
        return view('admin-pages/bank-details/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            
            'layout' => 'side-menu'
        ]);
    }
    public function bankDetailsList()
    {
        $BankDetails = BankDetails::all();
        return view('admin-pages/bank-details/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'BankDetails' => $BankDetails,
            'layout' => 'side-menu'
        ]);
    }
    public function saveBankDetails(Request $request)
    {
        try {
            $validated = $request->validate([
                'bank_name' => 'required|max:255',
                'account_no' => 'required|max:255',
                'opning_bank_balance' => 'required|max:255',
                'ifsc_code' => 'required|max:255',
                'close_on' => 'required|max:255',
            ]);

            $Bank = new BankDetails();
            $Bank->bank_name = $request->bank_name;
            $Bank->account_no = $request->account_no;
            $Bank->opning_bank_balance = $request->opning_bank_balance;

            $Bank->ifsc_code = $request->ifsc_code;
            $Bank->close_on = $request->close_on;
            $Bank->save();

            return redirect()->route('bank.list')->with('success', 'Bank Details saved successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while saving the Bank data.');
        }
    }
    public function editBankDetails($id)
    {


        $BankEdit = BankDetails::findOrFail($id);
        // dd($BankEdit);
        return view('admin-pages/bank-details/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'BankEdit' => $BankEdit,
            'layout' => 'side-menu'
        ]);
    }
    public function updateBankDetails(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'bank_name' => 'required|max:255',
                'account_no' => 'required|max:255',
                'opning_bank_balance' => 'required|max:255',
            ]);
            // Find the record by ID or create a new instance if not found
            $data = BankDetails::findOrFail($id);
            $data->bank_name = $request->bank_name;
            $data->account_no = $request->account_no;
            $data->opning_bank_balance = $request->opning_bank_balance;

            $data->ifsc_code = $request->ifsc_code;
            $data->close_on = $request->close_on;

            $data->updated_at = now();
            $data->save();
            return redirect()->route('bank.list')->with('success', 'Bank Details Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }

}
