<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        //If the user does not approve the request, the response contains an error message.
        $error = $request->input('error');
        //If the user approves the access request, then the response contains an authorization code.
        $code = $request->input('code');
        if ((isset($error) && $error === 'access_denied') || !isset($code)) {
            return redirect()->route('login');
        }

        try {
            $socialUser = Socialite::driver('google')->user();
            $socialId = $socialUser->id;
            $existingUser = User::where('email', $socialUser->email)->first();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('login');
        }

        if ($existingUser) {
            Auth::login($existingUser, true);  
        } else {
            $newUser = $this->processNewAccount($socialUser);
            Auth::login($newUser, true);
        }

        return redirect()->route('landing-page');
    }

    private function processNewAccount($socialUser)
    {
        $user = new User();

        $word = '0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()_';
        $passwd = str_shuffle($word);

        $user->name = $socialUser->name;
        $user->email = $socialUser->email;
        $user->password = $passwd;
        $user->save();

        return $user;
    }
}
