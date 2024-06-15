<?php

namespace App\Http\Controllers\API\Web;


use App\Http\Controllers\Controller;

use App\Models\Profile;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\User;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = User::paginate(15);
        return ProfileResource::collection($profiles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $profile = new User;
		$profile->name = $request->input('first_name');
		$profile->last_name = $request->input('last_name');
		$profile->email = $request->input('email');
		$profile->phone_no = $request->input('phone_no');
		$profile->state = $request->input('state');
        $profile->city = $request->input('city');
		$profile->date_of_birth = $request->input('date_of_birth');
        $profile->gender = $request->input('gender');
        $profile->type = 1;

        $profile->save();

        return response()->json($profile, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return new ProfileResource($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function User(ProfileRequest $request, $id)
    {
        $profile = Profile::findOrFail($id);
		$profile->name = $request->input('first_name');
		$profile->last_name = $request->input('last_name');
		$profile->email = $request->input('email');
		$profile->phone_no = $request->input('phone_no');
		$profile->state = $request->input('state');
        $profile->city = $request->input('city');
		$profile->date_of_birth = $request->input('date_of_birth');
        $profile->gender = $request->input('gender');
        $profile->save();

        return response()->json($profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = User::findOrFail($id);
        $profile->delete();

        return response()->json(null, 204);
    }
}
