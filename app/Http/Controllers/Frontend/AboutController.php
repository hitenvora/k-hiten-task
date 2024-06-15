<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\FounderManage;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class AboutController extends Controller
{
    public function aboutView(): View
    {
        $founder_profile = FounderManage::all();

        return view('front-pages.about', [
            'founder_profile' => $founder_profile,

        ]);
    }
}
