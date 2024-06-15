<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Product_img;
use App\Http\Requests\Product_imgRequest;
use App\Http\Resources\Product_imgResource;

class Product_imgsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_imgs = Product_img::orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
        return Product_imgResource::collection($product_imgs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Product_imgRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product_imgRequest $request)
    {
        $product_img = new Product_img;
		$product_img->product_id = $request->input('product_id');
		$product_img->img_path = $request->input('img_path');
        $product_img->save();

        return response()->json($product_img, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_img = Product_img::findOrFail($id);
        return new Product_imgResource($product_img);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Product_imgRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product_imgRequest $request, $id)
    {
        $product_img = Product_img::findOrFail($id);
		$product_img->product_id = $request->input('product_id');
		$product_img->img_path = $request->input('img_path');
        $product_img->save();

        return response()->json($product_img);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_img = Product_img::findOrFail($id);
        $product_img->delete();

        return response()->json(null, 204);
    }
}
