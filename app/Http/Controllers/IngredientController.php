<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\productIngredient;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IngredientController extends Controller
{
    public function IngredientList(): View
    {
        $ingredient = Ingredient::orderBy('id', 'DESC')->get();

        return view('admin-pages/ingredient/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'ingredient' => $ingredient,
            'layout' => 'side-menu'
        ]);
    }

    public function ManyToOneList(): View
    {

        $product = ProductIngredient::select('product_ingredien.*', 'products.product_name as product_name')
            ->leftJoin('products', 'product_ingredien.product_id', '=', 'products.id')
            ->orderBy('product_ingredien.id', 'DESC')
            ->get()
            ->groupBy('product_id');

        return view('admin-pages/conversion/many-to-one-list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'product' => $product,
            'layout' => 'side-menu'
        ]);
    }

    public function addIngredient(): View
    {
        return view('admin-pages/ingredient/add', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            'layout' => 'side-menu'
        ]);
    }

    public function editIngredient($id): View
    {
        $Ingredient = Ingredient::findOrFail($id);
        return view('admin-pages/ingredient/edit', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'Ingredient' => $Ingredient,
            'layout' => 'side-menu'
        ]);
    }

    public function saveIngredient(Request $request)
    {
        $Ingredient = new Ingredient;
        $Ingredient->name = $request->name;
        $Ingredient->mrp = $request->mrp;
        $Ingredient->qty = $request->qty;
        $Ingredient->loose = $request->loose ? 1 : 0;
        $Ingredient->save();

        return redirect()->route('ingredient.list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateIngredient(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'mrp' => 'required|max:255',
            'qty' => 'required|max:255',
        ]);

        $Ingredient = Ingredient::findOrFail($id);
        $Ingredient->name = $request->name;
        $Ingredient->mrp = $request->mrp;
        $Ingredient->qty = $request->qty;
        $Ingredient->loose = $request->loose ? 1 : 0;
        $Ingredient->save();

        return redirect()->route('ingredient.list');
    }
    public function productAddIngredient()
    {
        $Product = Product::where('status', 1)->orderBy('product_name', 'ASC')->get();
        $ingredient = Product::orderBy('product_name', 'ASC')->get();
        $volume = Product::orderBy('volume', 'ASC')->get();
        return view('admin-pages/ingredient/productAddIngredient', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'ingredient' => $ingredient,
            'Product' => $Product,
            'volume' => $volume,
            'layout' => 'side-menu'
        ]);
    }
    public function productEditIngredient($id)
    {

        $Product = Product::findOrFail($id);
        $Conversion = Conversion::where('product_one_id', $id)
            ->where('type', 1)
            ->first();
        $ingredient = Product::whereNot('id', $Product->id)->orderBy('id', 'DESC')->get();
        $productIngredient = productIngredient::where('product_id', $Product->id)->get();
        return view('admin-pages/ingredient/productEditIngredient', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            'productIngredient' => $productIngredient,
            'ingredient' => $ingredient,
            'Product' => $Product,
            'Conversion' => $Conversion,
            'layout' => 'side-menu'
        ]);
    }
    public function fetchingredient($id)
    {
        try {
            $ingredient = Ingredient::where('id', $id)->first()->toArray();
            // return new ProductResource($ingredient);
            return response()->json(['data' => $ingredient]);
        } catch (\Exception $e) {
            // Handle the exception, for example, return an error response
            return response()->json(['error' => 'Product not found.'], 404);
        }
    }
    public function saveIngredientData(Request $request)
    {   
        try{
            $validate = $request->validate([
                'ingredient' => 'required',
                'quantity' => 'required',
            ]);

            // Check if a similar conversion already exists in the database
            $existingConversion = Conversion::where('product_one_id', $request->product_id)
                ->where('type', 1)
                ->first();

            // If a similar conversion doesn't exist, proceed with saving
            if (!$existingConversion) {
                // Create a new Conversion instance 
                $conversion = new Conversion;
                // Assign values from the request to the Conversion model properties
                $conversion->product_one_id = $request->product_id;
                $conversion->threshold_qty = $request->threshold_qty;
                $conversion->manufactur_qty = $request->manufactur_qty;
                $conversion->type = 1;

                // Save the Conversion model to the database
                $conversion->save();
                // return response()->json(['message' => 'Conversion saved successfully'], 200);

            } else {
                // If a similar conversion exists, return an error message
                return response()->json(['error' => 'Conversion with these product IDs already exists'], 400);
            }

            foreach ($request->ingredient as $key => $value) {
                $cart = new productIngredient();
                $cart->ingredient_id = $value;
                $cart->product_id = $request->product_id;
                $cart->qty = $request->quantity[$key];
                $cart->save();
            }

            return redirect()->route('ManyToOneList')->with('success','Add Many-To-One Product successfully!');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors(['error' => 'Validation error. Please check your inputs and try again.']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while processing your request. Please try again.']);
        }
    }

    public function updateIngredientData(Request $request, $id)
    {
        $validate = $request->validate([
            'ingredient' => 'required',
            'quantity' => 'required',
        ]);

        $existingConversion = Conversion::where('product_one_id', $id)
            ->where('type', 1)
            ->first();

        // If a similar conversion doesn't exist, proceed with saving
        if (!$existingConversion) {
            $conversion = Conversion::findOrFail($id);
            $conversion->product_one_id = $id;

            $conversion->threshold_qty = $request->threshold_qty;
            $conversion->manufactur_qty = $request->manufactur_qty;
            $conversion->type = 1;
            $conversion->save();
        } else {
            $existingConversion->product_one_id = $id;

            $existingConversion->threshold_qty = $request->threshold_qty;
            $existingConversion->manufactur_qty = $request->manufactur_qty;
            $existingConversion->type = 1;
            $existingConversion->save();
        }

        foreach ($request->ingredient as $key => $value) {
            $productIngredient = productIngredient::where('ingredient_id', $value)->where('product_id', $request->product_id)->first();
            if ($productIngredient == null) {
                $productIngredient = new productIngredient();
                $productIngredient->product_id = $request->product_id;
            }
            $productIngredient->ingredient_id = $value;
            $productIngredient->qty = $request->quantity[$key];
            $productIngredient->save();
        }

        return redirect()->route('ManyToOneList');
    }

}
