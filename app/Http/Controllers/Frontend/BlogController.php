<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BlogLeaveReplayMail;
use App\Models\Blog;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    public function blogDetailsView($id): View
    {
        // $prodcut_cetegory = SubCategory::orderBy('id', 'desc')->get();
        // $auth= auth()->user()->id;

        $blog_latest = Blog::orderBy('id', 'desc')->get();

        // $prodcut_cetegory = SubCategory::paginate(7);
        // $blog = Blog::where('id', $id)->get();
        $blog = Blog::findOrFail($id);
        // $product = Product::paginate(9);
        // $populer_product = Product::where('populer', 1);
        return view('front-pages/blog-detail', [
            // 'prodcut_cetegory' => $prodcut_cetegory,
            // 'product' => $product,
            // 'populer_product' => $populer_product,
            'blog' => $blog,
            'blog_latest' => $blog_latest,


        ]);
    }

    public function blogView(): View
    {
        // $prodcut_cetegory = SubCategory::orderBy('id', 'desc')->get();
        $prodcut_cetegory = SubCategory::paginate(7);
        $product = Product::paginate(9);
        $blog = Blog::all();
        $populer_product = Product::where('populer', 1);
        return view('front-pages/blog', [
            'prodcut_cetegory' => $prodcut_cetegory,
            'product' => $product,
            'populer_product' => $populer_product,
            'blog' => $blog,


        ]);
    }

    
    public function blogLeavereplayMailSending(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'comment' => $request->comment,
            ];
    
    
            // Mail::to('pyjym@mailinator.com')->send(new AdMartechEmail($data));
            Mail::to('Info@kdfindia.com')->send(new BlogLeaveReplayMail($data));

            return redirect()->route('blog.view')->with('success', 'Your Message Send Successfully!');
        } catch (\Exception $e) {
            // dd($e);
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred errore Plase try again.');
        }
    }






}
