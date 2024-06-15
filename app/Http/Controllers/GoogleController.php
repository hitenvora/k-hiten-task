<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGmailCallback()
    {
        try {
            $user = Socialite::driver("google")->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended("wab/profile");
              
            } else {

                $newuser = User::create(["name" => $user->name, "email" => $user->email, 'type' => 1 ,"google_id" => $user->id, "password" => encrypt("123456dummy")]);
                Auth::login($newuser);
                return redirect()->intended("wab/profile");
           

            }
        } catch (Exception $e) {
            return back()->with('error', 'Something wrong!');
        }
    }
    
}
