<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\GstAndTextCategory;
use App\Http\Requests\GstAndTextCategoryRequest;
use App\Http\Resources\GstAndTextCategoryResource;

class GstAndTextCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gstandtextcategories = GstAndTextCategory::orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
        return GstAndTextCategoryResource::collection($gstandtextcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GstAndTextCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GstAndTextCategoryRequest $request)
    {
        $gstandtextcategory = new GstAndTextCategory;
		$gstandtextcategory->category_name = $request->input('category_name');
        $gstandtextcategory->save();

        return response()->json($gstandtextcategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gstandtextcategory = GstAndTextCategory::findOrFail($id);
        return new GstAndTextCategoryResource($gstandtextcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GstAndTextCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GstAndTextCategoryRequest $request, $id)
    {
        $gstandtextcategory = GstAndTextCategory::findOrFail($id);
		$gstandtextcategory->category_name = $request->input('category_name');
        $gstandtextcategory->save();

        return response()->json($gstandtextcategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gstandtextcategory = GstAndTextCategory::findOrFail($id);
        $gstandtextcategory->delete();

        return response()->json(null, 204);
    }
}
