<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function profileView(): View
    {

        return view('front-pages/profile');
    }

    public function profileUpdate(Request $request)
    {
        try {
            $data = User::find(Auth::user()->id);
            if ($data) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                    'date_of_birth' => 'required',

                    'city' => 'required',
                    'state' => 'required',
                    'address' => 'required',
                    'gender' => 'required',
                    'last_name' => 'required',

                    'contact_number' => [
                        'required',
                        'regex:/^[0-9]+$/',
                    ],
                ]);

                // Check for validation errors
                if ($validator->fails()) {
                    $response = [
                        'success' => false,
                        'message' => $validator->errors(),
                    ];
                    return response()->json($response, 400);
                }
                $data->name = $request->name;
                $data->email = $request->email;
                $data->date_of_birth = $request->date_of_birth;
                $data->contact_number = $request->contact_number;

                $data->city = $request->city;
                $data->state = $request->state;
                $data->address = $request->address;
                $data->gender = $request->gender;
                $data->last_name = $request->last_name;

                $data->save();
                
                return redirect()->back()->with('success', 'Profile Updated successfully.');
            } else {
                return redirect()->Route('index.view')->with('error', 'Something wrong!');
            }
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->Route('index.view')->with('error', 'Something wrong!');
        }
    }
}
