<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function registerUser(Request $request)
    {
        $request->validate([
            'nameInput' => 'required',
            'emailInput' => 'required|email:users',
            'passwordInput' => 'required|min:6',
            'repeatPasswordInput' => 'required_with:passwordInput|same:passwordInput',
            'mobileInput' => 'required|min:10'
        ]);

        $user = new User();
        $user->name = $request->nameInput;
        $user->email = $request->emailInput;
        $user->password = bcrypt($request->passwordInput);
        $user->phone_no = $request->mobileInput;
        $user->type = 1;




        $result = $user->save();
        if ($result) {
            return back()->with('success', 'You have registered successfully.');
        } else {

            return back()->with('error', 'Something wrong!');

        }
    }





    public function loginUser(Request $request)
    {
        try {
            $credentials = $request->only('loginemail', 'loginPassword');
            $userDetail = User::where('email', $request->loginemail)->first();

            if ($userDetail == null) {

                return back()->with('error', 'This email is not register.');

            }

            $credentials = [
                'email' => $userDetail->email, // replace $email with the actual email value
                'password' => $request->loginPassword // re place $password with the actual password value
            ];

            if (Auth::attempt($credentials)) {
                return redirect()->route('index.view')->with('success', 'You have Login successfully.');

            } else {

                // Authentication failed
                return back()->with('error', 'Password not match!');

            }
        } catch (\Exception $e) {
            // dd($e);
            // Error handling

            return back()->with('error', 'This email is not register.');

        }

    }





    // public function loginUser(Request $request)
    // {
    //     $request->validate([
    //         'loginemail' => 'required',
    //         'loginPassword' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         return redirect('/')
    //             ->with('success', 'You have Successfully loggedin');
    //     }
//  return redirect("/")->with('error', 'Oppes! You have entered invalid credentials');

    //     return redirect("/")->with('error', 'Oppes! You have entered invalid credentials');

    // }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route("index.view");
    }




    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect(route('index.view'));

    }

    // public function callbackFromGoogle()
    // {
    //     try {
    //         $user = Socialite::driver('google')->user();

    //         // Check Users Email If Already There
    //         $is_user = User::where('email', $user->getEmail())->first();
    //         if(!$is_user){

    //             $saveUser = User::updateOrCreate([
    //                 'google_id' => $user->getId(),
    //             ],[
    //                 'name' => $user->getName(),
    //                 'email' => $user->getEmail(),
    //                 'password' => Hash::make($user->getName().'@'.$user->getId())
    //             ]);
    //         }else{
    //             $saveUser = User::where('email',  $user->getEmail())->update([
    //                 'google_id' => $user->getId(),
    //             ]);
    //             $saveUser = User::where('email', $user->getEmail())->first();
    //         }


    //         Auth::loginUsingId($saveUser->id);

    //         return redirect()->route('index.view');
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }


    // public function callbackFromGoogle()
    // {
    //     try {

    // $googleUser = Socialite::driver('google')->user();
    //         // $googleUser = Socialite::driver('google')->stateless()->user();
// dd($googleUser);

    //         // Check if the user exists in the database
    //         $user = User::where('email', $googleUser->getEmail())->first();

    //         if (!$user) {
    //             // If the user does not exist, create a new user
    //             $user = User::create([
    //                 'name' => $googleUser->getName(),
    //                 'email' => $googleUser->getEmail(),
    //                 'password' => Hash::make($googleUser->getName() . '@' . $googleUser->getId()),
    //                 'google_id' => $googleUser->getId(), // Save Google ID for future use
    //             ]);
    //         } else {
    //             // If the user already exists, update the Google ID
    //             $user->update([
    //                 'google_id' => $googleUser->getId(),
    //             ]);
    //         }

    //         // Log in the user
    //         Auth::login($user);

    //         // Redirect the user to the desired page
    //         return redirect()->route('index.view');
    //     } catch (\Throwable $th) {
    //         // Handle exceptions, such as database errors or authentication failures
    //         // dd($th);
    //         return redirect()->route('index.view')->with('error', 'An error occurred during login. Please try again.');
    //     }
    // }



    public function callbackFromGoogle()
    {

        $googleUser = Socialite::driver('google')->stateless()->user();
        // dd($googleUser);

        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            // User doesn't exist, create a new one
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                // Add any other user information here
            ]);
        }

        Auth::login($user, true);

        return redirect('/'); // Redirect to home page or wherever you want
    }




//     public function callbackFromGoogle($provider)
//     {
//     //   if ($provider === 'apple') {
//     //     $token = app(Configuration::class)->parser()->parse(app(AppleToken::class)->generate());
//     //     config()->set('services.apple.client_secret', $token);
//     //   }
  
//       $socialUser = Socialite::driver($provider)->setHttpClient(new Client(['verify' => false]))->user();
  
//     //   $userIdentity = UserIdentity::where('provider_id', $socialUser->id)->where('provider_name', $provider)->first();
//     //   $userRole = UserRole::where('slug', 'user')->first();
//         $user = User::where('email', $socialUser->email)->first();
  


//       if ($userIdentity) {
//         // retrieve the user from users store
//         // $user = User::where('id', $userIdentity->user_id)->with('userRole')->with('account')->first();
  
//         // assign access token to user
//         $token = $user->createToken('social');
//         $accessToken = $token->accessToken;
  
//         $arguments = [
//           'success' => true,
//           'accessToken' => $accessToken,
//           'expiresAt' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
//           'user' => json_encode($user)
//         ];
  
//         return redirect()->away(env('CLIENT_URL') . '/social/callback?' . http_build_query($arguments));
//       } else {
//         $user = User::where('email', $socialUser->email)->with('userRole')->with('account')->first();
  
//         if (!($user && isset($user->id))) {
//           /* $newUser = User::create([
//             'fname' => $socialUser->name ?? '',
//             'lname' => '',
//             'email' => $socialUser->email,
//             'image' => $socialUser->avatar ?? '',
//             'user_role_id' => $userRole->id,
//             'account_id' => 1,
//             'password' => Hash::make(Str::random(40)),
//             'status' => 'active',
//           ]);
  
//           $user = User::where('email', $socialUser->email)->with('userRole')->with('account')->first(); */
  
//           $arguments = [
//             'success' => false,
//           ];
  
//           return redirect()->away(env('CLIENT_URL') . '/social/callback?' . http_build_query($arguments));
//         } else {
//           // store user social provider info
//         //   if ($user) {
//         //     UserIdentity::create([
//         //       'provider_name' => $provider,
//         //       'provider_id' => $socialUser->id,
//         //       'user_id' => $user->id,
//         //     ]);
//         //   }
  
//           // assign passport token to user
//           $token = $user->createToken('social');
//           $accessToken = $token->accessToken;
  
//           $arguments = [
//             'success' => true,
//             'accessToken' => $accessToken,
//             'expiresAt' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
//             'user' => json_encode($user)
//           ];
  
//           return redirect()->away(env('CLIENT_URL') . '/social/callback?' . http_build_query($arguments));
//         }
//       }



// }
}
