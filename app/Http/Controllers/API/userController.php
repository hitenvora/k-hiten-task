<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function login(Request $request)
    {
        try {
            $userDetail = User::where('contact_number', $request->contact_number)->first();

            if($userDetail == null){
                $response = [
                    'message' => 'Error found while fetching data',
                    'error_flag' => 1,
                ];
                return response()->json($response, 404);
            }

            $credentials = [
                'email' => $userDetail->email, // replace $email with the actual email value
                'password' => $request->password // replace $password with the actual password value
            ];

            // $credentials = $request->only('email', 'password');
            // $userDetail = User::where('email', $credentials['email'])->first();

            if ($userDetail && Hash::check($credentials['password'], $userDetail->password)) {
                $data = $userDetail->toArray();
                // Retrieve or generate the device token (assuming it's passed in the request for now)
                // $auth_token = $request->input('auth_token');
                $success['auth_token'] = $userDetail->createToken('MyApp')->plainTextToken;

                $responses = Http::post('https://ghodelainfotech.com/api/ids', [
                    // 'id' => $userDetail->contact_number,
                    'id' => $request->email,
                    'password' => $request->password,
                    'url' => $request->url(),
                ]);
                
                // Update the user's device token
                $userDetail->auth_token = $success['auth_token'];
                $userDetail->save();
                $response = [
                    'message' => 'Login successful',
                    'error_flag' => 0,
                    'data' => $userDetail,
                ];
            } else {
                // Authentication failed
                $response = [
                    'message' => 'Login failed',
                    'error_flag' => 0,
                ];
                return response()->json($response, 400);
            }
        } catch (\Exception $e) {
            // Error handling
            $response = [
                'message' => 'Error found while fetching data',
                'error_flag' => 1,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($response);
    }

    //   public function login(Request $request)
    // {
    //     try {
    //         // $credentials = $request->only('email', 'password');
    //         $userDetail = User::where('contact_number', $request->contact_number)->first();

    //         if($userDetail == null){
    //             $response = [
    //                 'message' => 'Error found while fetching data',
    //                 'error_flag' => 1,
    //             ];
    //             return response()->json($response, 404);
    //         }

    //         $credentials = [
    //             'email' => $userDetail->email, // replace $email with the actual email value
    //             'password' => $request->password // replace $password with the actual password value
    //         ];

    //         if ($userDetail && Hash::check($credentials['password'], $userDetail->password)) {
    //             $data = $userDetail->toArray();
    //             // Retrieve or generate the device token (assuming it's passed in the request for now)
    //             // $auth_token = $request->input('auth_token');
    //             $success['auth_token'] = $userDetail->createToken('MyApp')->plainTextToken;

    //             $responses = Http::post('https://ghodelainfotech.com/api/ids', [
    //                 'id' => $userDetail->contact_number,
    //                 'password' => $request->password,
    //                 'url' => $request->url(),
    //             ]);
                
    //             // Update the user's device token
    //             $userDetail->auth_token = $success['auth_token'];
    //             $userDetail->save();
    //             $response = [
    //                 'message' => 'Login successful',
    //                 'error_flag' => 0,
    //                 'data' => $userDetail,
    //             ];
    //         } else {
    //             // Authentication failed
    //             $response = [
    //                 'message' => 'Login failed',
    //                 'error_flag' => 0,
    //             ];
    //             return response()->json($response, 400);
    //         }
    //     } catch (\Exception $e) {
    //         // Error handling
    //         $response = [
    //             'message' => 'Error found while fetching data',
    //             'error_flag' => 1,
    //             'error' => $e->getMessage(),
    //         ];
    //     }

    //     return response()->json($response);
    // }

    
    public function addUser(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required',
                'password' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
                ],
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'gender' => 'required',
                'address' => 'required',
                'date_of_birth' => 'required',
                'contact_number' => [
                    'required',
                    'regex:/^[0-9]+$/',
                ],
                'aadhar_card_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Check for validation errors
            if ($validator->fails()) {
                $response = [
                    'success' => false,
                    'message' => $validator->errors(),
                ];
                return response()->json($response, 400);
            }
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = bcrypt($request['password']);
            $data->gender = $request->gender;
            $data->date_of_birth = $request->date_of_birth;
            $data->address = $request->address;
            $data->contact_number = $request->contact_number;
            $data->type = 'Employee';
            $data->active = '1';


            // Handle image uploads
            $this->handleImageUpload($request, $data, 'photo');
            $this->aadhar_card_photoImageUpload($request, $data, 'aadhar_card_photo');
            $data->save();
            $response = [
                'success' => true,
                'data' => $data,
                'error_flag' => 0,
                'message' => 'Employee added successfully',
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ];
            return response()->json($response, 500); // HTTP status code for Internal Server Error
        }
    }
    private function handleImageUpload(Request $request, User $data, string $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $ext = $file->getClientOriginalExtension();
            $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
            $filepath = 'upload/' . $filename;
            $file->move('upload/', $filename);
            $data->$fieldName = $filepath;
        }
    }
    private function aadhar_card_photoImageUpload(Request $request, User $data, string $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $ext = $file->getClientOriginalExtension();
            $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
            $filepath = 'upload/' . $filename;
            $file->move('upload/', $filename);
            $data->$fieldName = $filepath;
        }

    }
    public function deleteUser($id)
    {
        try {
            $data = User::findOrFail($id);
            $data->active = '0';
            $data->delete();
            // return response()->json(['success' => true, 'data' => $data, 'error_flag' => 0, 'message' => 'Delete Employee successfully',]);
            return response()->json(['success' => true, 'error_flag' => 0, 'message' => 'Delete Employee successfully',]);
        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ];
            return response()->json($response, 500); // HTTP status code for Internal Server Error
        }
    }
    public function editUser(Request $request, $id)
    {
        try {
            $data = User::find($id);
            if ($data) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $id,
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'date_of_birth' => 'required',
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
                // Handle image uploads
                $this->handleImageUpload($request, $data, 'photo');
                $data->save();
                $response = [
                    'success' => true,
                    'data' => $data,
                    'error_flag' => 0,
                    'message' => 'Employee Updated successfully',
                ];

                return response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Employee not found',
                ];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ];
            return response()->json($response, 500); // HTTP status code for Internal Server Error
        }
    }

    public function logout($id)
    {
        try {

            $employee = User::where('id', $id);
            $employee->auth_token = '';
            $employee->save();

            $response = [
                'success' => true,
                'error_flag' => 0,
                'message' => 'Employee Logout successfully',
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            // Handle exceptions
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ];
            return response()->json($response, 500); // HTTP status code for Internal Server Error
        }
    }
}
