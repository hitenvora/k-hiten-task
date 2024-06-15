<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\FooterMail;
use App\Models\FounderManage;
use App\Models\FronteImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Carbon\Carbon;


class IndexController extends Controller
{
    public function indexView(): View
    {
        $product_categories = SubCategory::all();
        $populer_product = Product::where('popular', 1)->get();
        $blog = Blog::all();
        // $populer_desc = Product::orderBy('id', 'desc')->get();
        $populer_desc = Product::orderBy('created_at', 'desc')->limit(15)->get();



        // $startDate = Carbon::now()->subWeeks(2); // Get the start date (2 weeks ago)
        // $endDate = Carbon::now(); // Get the end date (today)

        // $populer_desc = Product::whereDate('created_at', '>=', $startDate)
        //     ->whereDate('created_at', '<=', $endDate)
        //     ->orderBy('id', 'desc')
        //     ->get();


        $front_image = FronteImage::all();

        return view('front-pages/index', [
            'product_categories' => $product_categories,
            'populer_product' => $populer_product,
            'blog' => $blog,
            'populer_desc' => $populer_desc,
            'front_image' => $front_image,
        ]);
    }


    public function footer_mail_save(Request $request)
    {
        // dd($request->all());
        try {

            $footer_mail = new FooterMail();
            $footer_mail->email = $request->email;

            // dd($filepath);
            $footer_mail->save();

            return redirect()->route('index.view')->with('success', 'Your Mail Subscribe Successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions

            return redirect()->back()->with('error', 'An error occurred while Subscribe the Your Mail data.');
        }
    }
}
