<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\SubCategory;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::orderBy('popular', 'ASC')
        ->get();

        // $data=[];
        //     foreach ($subcategories as $list) {
        //         if ($list->GetProducts->count() != 0) {
        //             $data[] = [
        //                 'id' => $list->id,
        //                 'categorieid' => $list->categorieid,
        //                 'name' => $list->name,
        //                 'image' => $list->image,
        //             ];
        //         }
        //     }
        
        // return $data;

        return SubCategoryResource::collection($subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categorieid' => 'required',
            'name' => 'required',
            'image' => 'required',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }

        $subcategory = new SubCategory;
        $subcategory->categorieid = $request->input('categorieid');
        $subcategory->name = $request->input('name');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
            $filepath = 'upload/' . $filename;
            $file->move('upload/', $filename);
            $subcategory->image = $filepath;
        }

        $subcategory->save();

        return response()->json($subcategory, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        return new SubCategoryResource($subcategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->categorieid = $request->input('categorieid');
        $subcategory->name = $request->input('name');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'image-' . time() . '_' . generateString() . '.' . $ext;
            $filepath = 'upload/' . $filename;
            $file->move('upload/', $filename);
            $subcategory->image = $filepath;
        }
        $subcategory->save();

        return response()->json($subcategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return response()->json(null, 204);
    }
}
