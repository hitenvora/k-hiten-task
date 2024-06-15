<?php

namespace App\Http\Controllers\API\Web;

use App\Http\Controllers\Controller;

use App\Models\ContectU;
use App\Http\Requests\ContectURequest;
use App\Http\Resources\ContectUResource;

class ContectusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contectuses = ContectU::paginate(15);
        return ContectUResource::collection($contectuses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContectURequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContectURequest $request)
    {
        $contectu = new ContectU;
		$contectu->name = $request->input('name');
		$contectu->email = $request->input('email');
		$contectu->message = $request->input('message');
        $contectu->save();

        return response()->json($contectu, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contectu = ContectU::findOrFail($id);
        return new ContectUResource($contectu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContectURequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContectURequest $request, $id)
    {
        $contectu = ContectU::findOrFail($id);
		$contectu->name = $request->input('name');
		$contectu->email = $request->input('email');
		$contectu->message = $request->input('message');
        $contectu->save();

        return response()->json($contectu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contectu = ContectU::findOrFail($id);
        $contectu->delete();

        return response()->json(null, 204);
    }
}
