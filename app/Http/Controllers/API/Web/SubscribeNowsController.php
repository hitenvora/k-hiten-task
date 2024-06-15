<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;

use App\Models\SubscribeNow;
use App\Http\Requests\SubscribeNowRequest;
use App\Http\Resources\SubscribeNowResource;

class SubscribeNowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribenows = SubscribeNow::paginate(15);
        return SubscribeNowResource::collection($subscribenows);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubscribeNowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscribeNowRequest $request)
    {
        $subscribenow = new SubscribeNow;
		$subscribenow->email = $request->input('email');
        $subscribenow->save();

        return response()->json($subscribenow, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscribenow = SubscribeNow::findOrFail($id);
        return new SubscribeNowResource($subscribenow);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubscribeNowRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubscribeNowRequest $request, $id)
    {
        $subscribenow = SubscribeNow::findOrFail($id);
		$subscribenow->email = $request->input('email');
        $subscribenow->save();

        return response()->json($subscribenow);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscribenow = SubscribeNow::findOrFail($id);
        $subscribenow->delete();

        return response()->json(null, 204);
    }
}
