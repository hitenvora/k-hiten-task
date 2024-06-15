<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FronteImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    // public function productView(Request $request): View
    // {


    //     $populer_product = Product::where('popular', 1)->get();



    //     $product_categories = SubCategory::all();

    // $category_id = $request->input('category_id');
    //     $products_query = Product::query();

    // if ($category_id) {
    //         $products_query->where('sub_category', $category_id);
    // }

    // $products = $products_query->paginate(9);
    //     $products->appends(['category_id' => $category_id]);


    //     $front_image = FronteImage::all();



    //     return view('front-pages/product', [
    //        'product_categories' => $product_categories,
    //         'products' => $products,
    //         'populer_product' => $populer_product,
    //         'front_image' => $front_image,

    //     ]);
    // }

    public function productView(Request $request): View
    {
        // Fetch popular products
        $populer_product = Product::where('popular', 1)->get();
    
        // Fetch all product categories
        $product_categories = SubCategory::all();
    
        // Retrieve the selected category ID from the request
        $category_id = $request->input('category_id');
    
        // Retrieve the search query from the request
        $search_query = $request->input('search');
    
        // Initialize the query to fetch products
        $products_query = Product::query();
    
        // If a category ID is provided, filter products by that category
        if ($category_id) {
            $products_query->where('sub_category', $category_id);
        }
    
        // If a search query is provided, filter products by search query
        if ($search_query) {
            $products_query->where('product_name', 'like', '%' . $search_query . '%');
        }
    
        // Retrieve the products based on the query
        $products = $products_query->paginate(9);
    
        // Append the category ID and search query to the pagination links
        $products->appends(['category_id' => $category_id, 'search' => $search_query]);
    
        // Fetch front images
        $front_image = FronteImage::all();
    
        // Pass data to the view
        return view('front-pages.product', [
            'product_categories' => $product_categories,
            'products' => $products,
            'populer_product' => $populer_product,
            'front_image' => $front_image,
        ]);
    }
    
    
   









}
