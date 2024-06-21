<?php

namespace App\Http\Controllers;

use App\Models\CustolerLogin;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function google_redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function google_callback(){
        try {
            $user = Socialite::driver('google')->user();

            $existingUser = CustolerLogin::where('email', $user->getEmail())->first();

            if ($existingUser) {
                Auth::guard('customerlogin')->login($existingUser);
            } else {
                $newUser = CustolerLogin::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => bcrypt(Str::random(16)), // Generate a random password
                    'created_at' => Carbon::now(),
                ]);
                Auth::guard('customerlogin')->login($newUser);
            }

            return redirect('/');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Unable to login using Google. Please try again.']);
        }
    }
}
