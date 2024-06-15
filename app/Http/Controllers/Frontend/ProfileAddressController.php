<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileAddressController extends Controller
{
    public function profileaddressView(Request $request ,$type): View
    {
        // dd(auth()->id());
        $view_address = OrderAddress::where('user_id', auth()->id())->get();
        return view('front-pages/address_profile', [
            'view_address' => $view_address,
            'type' => $type,



        ]);
    }


    // public function saveProfileaddress(Request $request)
    // {
    //     // dd($request->all());
    //         try {
    //             $validatedData = $request->validate([
    //                 'pincode' => [new \App\Rules\AvailablePincode],
    //                 // Other validation rules...
    //         ]);


    //             $user_id = auth()->user()->id;
    //             $address_profile = new OrderAddress();
    //             $address_profile->first_name = $request->first_name;
    //             $address_profile->last_name = $request->last_name;
    //             $address_profile->email = $request->email;
    //             $address_profile->mobile_no = $request->mobile_no;
    //             $address_profile->city = $request->city;
    //             $address_profile->state = $request->state;
    //             $address_profile->addresss = $request->addresss;
    //             $address_profile->pincode = $request->pincode;
    //             $address_profile->user_id = $user_id;
    //             $address_profile->save();

    //             return redirect()->route('profile_address.view')->with('success', 'Your Address Saved Successfully!');
    //         } catch (\Exception $e) {
    //         // dd($e);
    //             // Handle other exceptions
    //             // return redirect()->back()->with('error', 'An error occurred while saving the Address data.');
    //         // return redirect()->back()->withErrors($validated)->withInput();
    //         // return redirect()->back()->withErrors($request->validate())->withInput();
    //         // return redirect()->back()->with('error', 'An error occurred while saving the Address data.');
    //         return redirect()->back()->withErrors($request->$validatedData)->withInput();

    //         }
    //     }


    public function saveProfileaddress(Request $request)
    {
        // $validatedData = $request->validate([
        //     'pincode' => [new \App\Rules\AvailablePincode],
        //     // Other validation rules...
        // ]);
    
        try {
            // Your code for successful validation goes here...
    
            $user_id = auth()->user()->id;
            $address_profile = new OrderAddress();
            $address_profile->first_name = $request->first_name;
            $address_profile->last_name = $request->last_name;
            $address_profile->email = $request->email;
            $address_profile->mobile_no = $request->mobile_no;
            $address_profile->city = $request->city;
            $address_profile->state = $request->state;
            $address_profile->addresss = $request->addresss;
            $address_profile->pincode = $request->pincode;
            $address_profile->address_type = $request->address_type;
            $address_profile->user_id = $user_id;
        
            $address_profile->save();
            // {{ route('profile_address.view', 0) }}
            return redirect()->route('profile_address.view', 0)->with('success', 'Your Address Saved Successfully!');
        } catch (\Exception $e) {
    
            // Handle other exceptions
            // return redirect()->back()->withErrors($validatedData)->withInput();
            return response()->json(['success' => false, 'message' => 'Error Delete data: ' . $e->getMessage()]);

        }
    }
    



    public function delete_profile_address($id)
    {
        try {
            $delete_profile = OrderAddress::findOrFail($id);
            $delete_profile->delete();

            return redirect()->route('profile_address.view', 0)->with('success', 'blog  Updated successfully!');
        } catch (\Exception $e) {
        // Handle the exception
        return redirect()->back()->with('error', 'An error occurred while saving the Address data.');

    }
    }


    public function fetchAddressData($id)
    {
        // Fetch the address data based on the provided ID
        $address = OrderAddress::findOrFail($id);

        // Return the address data as JSON response
        return response()->json($address);
    }





    public function edit_profile_address($id)
    {

        $view_address = OrderAddress::where('user_id', auth()->id())->get();

        $edit_profile_address = OrderAddress::findOrFail($id);
        // dd($edit_profile_address);
        return view('front-pages/address_profile_edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'edit_profile_address' => $edit_profile_address,
            'view_address' => $view_address,
       

        ]);
    }




    public function update_profile_address(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'pincode' => [new \App\Rules\AvailablePincode],
        //     // Other validation rules...
        // ]);
        try {
            // $validated = $request->validate([
            //     'title' => 'required|max:255',
            //     'message' => 'required|max:255',

            // ]);
            // Find the record by ID or create a new instance if not found


           

            $data = OrderAddress::findOrFail($id);
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->mobile_no = $request->mobile_no;
            $data->city = $request->city;
            $data->state = $request->state;
            $data->addresss = $request->addresss;
            $data->pincode = $request->pincode;
            $data->address_type = $request->address_type;


            $data->updated_at = now();
            $data->save();
            return redirect()->route('profile_address.view', 0)->with('success', 'Your Address Update Successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions
            // return redirect()->back()->withErrors($validatedData)->withInput();
            return redirect()->back()->with('error', 'An error occurred while saving the Address data.');

        }
    
    }

}
