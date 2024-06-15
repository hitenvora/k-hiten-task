<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function faqView(): View
    {
        $prodcut_cetegory = SubCategory::paginate(7);
        $product = Product::paginate(9);
        $populer_product = Product::where('populer', 1);
        return view('front-pages/faq', [
            'prodcut_cetegory' => $prodcut_cetegory,
            'product' => $product,
            'populer_product' => $populer_product,
        ]);
    }
}
