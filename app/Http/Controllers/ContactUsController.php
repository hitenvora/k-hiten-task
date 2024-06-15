<?php

namespace App\Http\Controllers;

use App\Models\ContectU;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ContactUsController extends Controller
{
    
    public function contect_usList(): View
    {
        $contect_usList = ContectU::orderBy('id', 'ASC')->get();
        // $gsts = GstAndTextCategory::where('category_name', '!=', '')->orderBy('id', 'DESC')->get();

        return view('admin-pages/contect-us/list', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'
            // 'gsts' => $gsts,
            'contect_usList' => $contect_usList,
            'layout' => 'side-menu'
        ]);
    }

}
