<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function privacyPolicyView()
    {
        return view('front-pages/PrivacyPolicy');
    }
}
