<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Exception;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $productsList = Product::where('status', 1)->orderBy('id', 'DESC')->get();
            $products = [];
            foreach ($productsList as $List) {
                // if ( isset($List->GetInventory) && isset($List->GetInventory) && $List->GetInventory->inventorie != 0) {

                $products[] = [
                    "id" => $List->id,
                    "product_name" => $List->product_name,
                    "description" => $List->description,
                    "meta_title" => $List->meta_title,
                    "volume" => $List->volume,
                    "meta_description" => $List->meta_description,
                    // "category" => $List->GetCategory->name,
                    "sub_category" => $List->subCategory->name,
                    "per_gram_price" => $List->per_gram_price,
                    "per_kg_price" => $List->per_kg_price,
                    "image" => $List->image,
                    "barcodenumber" => $List->barcodenumber,
                    "barcode_img" => $List->barcode_img,
                    "lush" => $List->lush,
                    "decimal" => $List->decimal,
                    "discount" => $List->discount,
                    "firm_id" => $List->getFirm->name,
                    
                    'price_1'  => $List->price_1,
                    'price_2'  => $List->price_2,
                    'price_3'  => $List->price_3,
                    'price_4'  => $List->price_4,
                    'kg_1'  => $List->kg_1,
                    'kg_2'  => $List->kg_2,
                    'kg_3'  => $List->kg_3,
                    'kg_4'  => $List->kg_4,
                    
                ];
                // }
            }
            if ($products != []) {
                return response()->json($products);
            } else {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Product not available',

                ];
                return response()->json($response, 404);
            }
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
                'data' => $e,

            ];
            return response()->json($response, 500);
        }
    }

    public function popularList()
    {
        try {

            $productsList = Product::where('status', 1)->where('popular', 1)->orderBy('id', 'DESC')->get();
            $products = [];
            foreach ($productsList as $List) {
                // if (isset($List->GetInventory) && $List->GetInventory->inventorie != 0) {

                $products[] = [
                    "id" => $List->id,
                    "product_name" => $List->product_name,
                    "description" => $List->description,
                    "meta_title" => $List->meta_title,
                    "volume" => $List->volume,
                    "meta_description" => $List->meta_description,
                    // "category" => $List->GetCategory->name,
                    "sub_category" => $List->subCategory->name,
                    "per_gram_price" => $List->per_gram_price,
                    "per_kg_price" => $List->per_kg_price,
                    "image" => $List->image,
                    "barcodenumber" => $List->barcodenumber,
                    "barcode_img" => $List->barcode_img,
                    "lush" => $List->lush,
                    "decimal" => $List->decimal,
                    "discount" => $List->discount,
                    "firm_id" => $List->getFirm->name,
                    
                    'price_1'  => $List->price_1,
                    'price_2'  => $List->price_2,
                    'price_3'  => $List->price_3,
                    'price_4'  => $List->price_4,
                    'kg_1'  => $List->kg_1,
                    'kg_2'  => $List->kg_2,
                    'kg_3'  => $List->kg_3,
                    'kg_4'  => $List->kg_4,
                ];
                // }
            }
            if ($products != []) {
                return response()->json($products);
            } else {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Product not available',

                ];
                return response()->json($response, 404);
            }
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
                'data' => $e,

            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = new Product;
            $product->product_name = $request->input('product_name');
            $product->description = $request->input('description');
            $product->meta_title = $request->input('meta_title');
            $product->volume = $request->input('volume');
            $product->meta_description = $request->input('meta_description');
            // $product->category = $request->input('category');
            $product->sub_category = $request->input('sub_category');
            $product->per_gram_price = $request->input('per_gram_price');
            $product->image = $request->input('image');
            $product->barcodenumber = $request->input('barcodenumber');
            $product->barcode_img = $request->input('barcode_img');
            $product->gst = $request->input('gst');
            $product->discount = $request->input('discount');
            $product->firm_id = $request->input('firm_id');
            $product->save();

            return response()->json($product, 200);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'error_flag' => 1,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
                'data' => $e,

            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return new ProductResource($product);
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Update the product attributes
            $product->product_name = $request->input('product_name');
            $product->description = $request->input('description');
            $product->meta_title = $request->input('meta_title');
            $product->volume = $request->input('volume');
            $product->meta_description = $request->input('meta_description');
            // $product->category = $request->input('category');
            $product->sub_category = $request->input('sub_category');
            $product->per_gram_price = $request->input('per_gram_price');
            $product->image = $request->input('image');
            $product->barcodenumber = $request->input('barcodenumber');
            $product->barcode_img = $request->input('barcode_img');
            $product->gst = $request->input('gst');
            $product->discount = $request->input('discount');
            $product->firm_id = $request->input('firm_id');
            $product->save();

            return response()->json($product);
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'Product not found or could not be updated.'], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'Product not found or could not be deleted.'], 404);
        }
    }


    // public function barcode($barcodeId)
    // {
    //     try {
    //         $productsList = Product::where('barcodenumber', $barcodeId)->First();

    //         // foreach ($productsList as $List) {
    //             // if (isset($List->GetInventory) && $List->GetInventory->inventorie != 0) {

    //             $products = [
    //                 "id" => $productsList->id,
    //                 "product_name" => $productsList->product_name,
    //                 "description" => $productsList->description,
    //                 "meta_title" => $productsList->meta_title,
    //                 "volume" => $productsList->volume,
    //                 "meta_description" => $productsList->meta_description,
    //                 // "category" => $productsList->GetCategory->name,
    //                 "sub_category" => $productsList->subCategory->name,
    //                 "per_gram_price" => $productsList->per_gram_price,
    //                 "per_kg_price" => $productsList->per_kg_price,
    //                 "image" => $productsList->image,
    //                 "barcodenumber" => $productsList->barcodenumber,
    //                 "barcode_img" => $productsList->barcode_img,
    //                 "lush" => $productsList->lush,
    //                 "decimal" => $productsList->decimal,
    //                 "discount" => $productsList->discount,
    //                 "firm_id" => $productsList->getFirm->name,
    //             ];
    //             // }
    //         // }
    //         if ($products != []) {
    //             return response()->json($products);
    //         } else {
    //             $response = [
    //                 'success' => false,
    //                 'data' => '',
    //                 'error_flag' => 1,
    //                 'message' => 'Product not available',

    //             ];
    //             return response()->json($response, 404);
    //         }
            
    //     } catch (\Exception $e) {
    //         dd($e);
    //         // Handle the exception, for example, return an error response
    //         return response()->json(['error' => 'An error occurred while processing the request.'], 500);
    //     }
    // }


    public function barcode($barcodeId)
    {
        try {
            $productsList = Product::where('barcodenumber', $barcodeId)->get();
            foreach ($productsList as $List) {
                // if (isset($List->GetInventory) && $List->GetInventory->inventorie != 0) {
                $products[] = [
                    "id" => $List->id,
                    "product_name" => $List->product_name,
                    "description" => $List->description,
                    "meta_title" => $List->meta_title,
                    "volume" => $List->volume,
                    "meta_description" => $List->meta_description,
                    // "category" => $List->GetCategory->name,
                    "sub_category" => $List->subCategory->name,
                    "per_gram_price" => $List->per_gram_price,
                    "per_kg_price" => $List->per_kg_price,
                    "image" => $List->image,
                    "barcodenumber" => $List->barcodenumber,
                    "barcode_img" => $List->barcode_img,
                    "lush" => $List->lush,
                    "decimal" => $List->decimal,
                    "discount" => $List->discount,
                    "firm_id" => $List->getFirm->name,
                    
                    'price_1'  => $List->price_1,
                    'price_2'  => $List->price_2,
                    'price_3'  => $List->price_3,
                    'price_4'  => $List->price_4,
                    'kg_1'  => $List->kg_1,
                    'kg_2'  => $List->kg_2,
                    'kg_3'  => $List->kg_3,
                    'kg_4'  => $List->kg_4,
                ];
                // }
            }
            if ($products != []) {
                return response()->json($products);
            } else {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Product not available',
                ];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }


    public function subcategory($subcategoryId)
    {
        try {
            $products = [];
            $product = Product::where('sub_category', $subcategoryId)->where('status', 1)->orderBy('id', 'DESC')->get();

            foreach ($product as $List) {
                // if (isset($List->GetInventory) && $List->GetInventory->inventorie != 0) {
                $products[] = [
                    "id" => $List->id,
                    "product_name" => $List->product_name,
                    "description" => $List->description,
                    "meta_title" => $List->meta_title,
                    "volume" => $List->volume,
                    "meta_description" => $List->meta_description,
                    //"category" => $List->GetCategory->name,
                    "sub_category" => $List->subCategory->name,
                    "per_gram_price" => $List->per_gram_price,
                    "per_kg_price" => $List->per_kg_price,
                    "image" => $List->image,
                    "barcodenumber" => $List->barcodenumber,
                    "barcode_img" => $List->barcode_img,
                    "lush" => $List->lush,
                    "decimal" => $List->decimal,
                    "discount" => $List->discount,
                    "firm_id" => $List->getFirm->name,
                    
                    'price_1'  => $List->price_1,
                    'price_2'  => $List->price_2,
                    'price_3'  => $List->price_3,
                    'price_4'  => $List->price_4,
                    'kg_1'  => $List->kg_1,
                    'kg_2'  => $List->kg_2,
                    'kg_3'  => $List->kg_3,
                    'kg_4'  => $List->kg_4,
                ];
                // }
            }

            if (!empty($products)) {
                return response()->json($products);
            } else {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Product not available',
                ];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }


    public function productByName($name)
    {
        try {
            $products = [];
            $product = Product::where('product_name', 'like', '%' . $name . '%')->where('status', 1)->orderBy('id', 'DESC')->get();

            foreach ($product as $List) {
                // if (isset($List->GetInventory) && $List->GetInventory->inventorie != 0) {
                $products[] = [
                    "id" => $List->id,
                    "product_name" => $List->product_name,
                    "description" => $List->description,
                    "meta_title" => $List->meta_title,
                    "volume" => $List->volume,
                    "meta_description" => $List->meta_description,
                    //"category" => $List->GetCategory->name,
                    "sub_category" => $List->subCategory->name,
                    "per_gram_price" => $List->per_gram_price,
                    "per_kg_price" => $List->per_kg_price,
                    "image" => $List->image,
                    "barcodenumber" => $List->barcodenumber,
                    "barcode_img" => $List->barcode_img,
                    "lush" => $List->lush,
                    "decimal" => $List->decimal,
                    "discount" => $List->discount,
                    "firm_id" => $List->getFirm->name,
                    
                    'price_1'  => $List->price_1,
                    'price_2'  => $List->price_2,
                    'price_3'  => $List->price_3,
                    'price_4'  => $List->price_4,
                    'kg_1'  => $List->kg_1,
                    'kg_2'  => $List->kg_2,
                    'kg_3'  => $List->kg_3,
                    'kg_4'  => $List->kg_4,
                ];
                // }
            }

            if (!empty($products)) {
                return response()->json($products);
            } else {
                $response = [
                    'success' => false,
                    'data' => '',
                    'error_flag' => 1,
                    'message' => 'Product not available',
                ];
                return response()->json($response, 404);
            }
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }
}
