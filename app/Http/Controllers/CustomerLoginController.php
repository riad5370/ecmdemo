<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CustomerLoginController extends Controller
{
    public function customerLogin(Request $request){
        if(Auth::guard('customerlogin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('index')->withSuccess('You have successfully login'); 
        }
        else {
            return back()->withError('Whoops! Something went wrong.These credentials do not match our records');
        }
    }
    public function Logout(){
        Auth::guard('customerlogin')->logout();
        return Redirect::route('customer.signup');
    }
}
