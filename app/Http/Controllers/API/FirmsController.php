<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Firm;
use App\Http\Requests\FirmRequest;
use App\Http\Resources\FirmResource;

class FirmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firms = Firm::orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
        return FirmResource::collection($firms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FirmRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FirmRequest $request)
    {
        $firm = new Firm;
		$firm->name = $request->input('name');
		$firm->gst_text = $request->input('gst_text');
        $firm->save();

        return response()->json($firm, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $firm = Firm::findOrFail($id);
        return new FirmResource($firm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FirmRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FirmRequest $request, $id)
    {
        $firm = Firm::findOrFail($id);
		$firm->name = $request->input('name');
		$firm->gst_text = $request->input('gst_text');
        $firm->save();

        return response()->json($firm);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firm = Firm::findOrFail($id);
        $firm->delete();

        return response()->json(null, 204);
    }
}
