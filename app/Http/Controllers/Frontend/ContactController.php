<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContectUsMail;
use App\Models\ContectU;
use App\Models\WebOrderCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function contactView(): View
    {
       
      
        return view('front-pages/contact');
    }



    public function saveContectus(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'phone_no' => 'required|max:255',
                'message' => 'required|max:255',
            ]);

            $contect_us_save = new ContectU();
            $contect_us_save->name = $request->name;
            $contect_us_save->email = $request->email;
            $contect_us_save->phone_no = $request->phone_no;
            $contect_us_save->message = $request->message;
            $contect_us_save->save();



            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'message' => $request->message
            ];
    
    
            // Mail::to('pyjym@mailinator.com')->send(new AdMartechEmail($data));
            Mail::to('Info@kdfindia.com')->send(new ContectUsMail($data));

            return redirect()->route('contact.view')->with('success', 'Your Message Send Successfully!');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->with('error', 'An error occurred errore Plase try again.');
        }
    }




}
