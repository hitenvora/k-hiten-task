<?php

namespace App\Http\Controllers;

use App\Models\AdminCustomerModels;
use App\Models\AppOrder;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AdminCustomerController extends Controller
{
    public function addCustomerData(): View
    {

        return view('admin-pages/adminCustomer/addCustomer', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            // 'add_customer' => $orders,
            'layout' => 'side-menu'
        ]);
    }
    public function customerList()
    {
        $customerData = AdminCustomerModels::all();
        return view('admin-pages/adminCustomer/customerList', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'customerData' => $customerData,
            'layout' => 'side-menu'
        ]);
    }

    public function userList()
    {
        $customerData = User::where('type',1)->get();
        return view('admin-pages/adminCustomer/user-list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'userData' => $customerData,
            'layout' => 'side-menu'
        ]);
    }

    public function customer($id)
    {
        $customer = AdminCustomerModels::findOrFail($id);
        $AppOrders = AppOrder::where('admin_client_id',$id)->where('type',0)->orderBy('id', 'DESC')->get();
        $AdminOrders = AppOrder::where('admin_client_id',$id)->where('type',2)->orderBy('id', 'DESC')->get();
        return view('admin-pages/adminCustomer/customer', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'customer' => $customer,
            'AdminOrders' => $AdminOrders,
            'AppOrders' => $AppOrders,
            'layout' => 'side-menu'
        ]);
    }
    public function saveCustomerData(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|unique:admin_customer,email',
                'contact_no' => 'required|', // Set maximum length to 10 characters
                'address' => 'required|max:255',
                'company_name' => 'required|max:255',
                'gst_no' => 'required|max:255',
            ]);

            $customer = new AdminCustomerModels();
            $customer->first_name = $request->input('first_name');
            $customer->last_name = $request->input('last_name');
            $customer->email = $request->input('email');
            $customer->contact_number = $request->input('contact_no');
            $customer->address = $request->input('address');
            $customer->company_name = $request->input('company_name');
            $customer->gst_number = $request->input('gst_no');
            $customer->type = 1;
            $customer->save();

            return redirect()->route('admin.customerList')->with('success', 'Customer added successfully!');
        } catch (ValidationException $e) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->validator->getMessageBag())->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred while saving the customer data.');
        }
    }
    public function updatecustomer($id)
    {
        $customer = AdminCustomerModels::findOrFail($id);
        return view('admin-pages/adminCustomer/updateCustomer', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'customer' => $customer,
            'layout' => 'side-menu'
        ]);
    }
    public function updateCustomerData(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|max:255',
                // 'last_name' => 'required|max:255',
                'last_name' => 'nullable|max:255',
                // 'email' => 'required|email|unique:admin_customer,email,' . $id,
                'email' => 'nullable|email|unique:admin_customer,email,' . $id,
                'contact_no' => 'required|max:10', // Set maximum length to 10 characters
                // 'address' => 'required|max:255',
                'address' => 'nullable|max:255',
                // 'company_name' => 'required|max:255',
                'company_name' => 'nullable|max:255',
                // 'gst_no' => 'required|max:255',
                'gst_no' => 'nullable|max:255',
            ]);
            // Find the record by ID or create a new instance if not found
            $data = AdminCustomerModels::findOrFail($id);
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->contact_number = $request->contact_no;
            $data->address = $request->address;
            $data->company_name = $request->company_name;
            $data->gst_number = $request->gst_no;

            $data->type = 1;
            $data->updated_at = now();
            $data->save();

            return redirect()->route('admin.customerList')->with('success', 'Customer data Updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => 'Error updating data: ' . $e->getMessage()]);
        }
    }
}
