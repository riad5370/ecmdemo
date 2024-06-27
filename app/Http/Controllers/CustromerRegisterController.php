<?php

namespace App\Http\Controllers;
use App\Models\CustolerLogin;
use App\Models\CustomerEmailVerify;
use App\Notifications\CustomerEmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CustromerRegisterController extends Controller
{
    public function customerRegister(Request $request){
        //all-data
        $customer_data = [
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|string|min:8',
            'password_confirmation'=> 'required|same:password',
        ];
        //data-validate
        $validateData = $request->validate($customer_data);

        //password-bcrypt
        $validateData['password'] = bcrypt($validateData['password']);

        //data-store
        $customer = CustolerLogin::create($validateData);

        if(Auth::guard('customerlogin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('index')->withSuccess('You have successfully login'); 
        }
        else {
            return back()->withError('Whoops! Something went wrong.These credentials do not match our records');
        }  
    }

    //mail-verify
    // public function verifyMail($token){
    //     $customer = CustomerEmailVerify::where('token',$token)->firstOrFail();
    //     CustolerLogin::findOrFail($customer->customer_id)->update([
    //         'email_verified_at'=>Carbon::now()->format('Y-m-d')
    //     ]);
    //     $customer->delete();
    //     return Redirect::route('customer.signup')->withSuccess('Your Email Verified Successfully! Now You Can Login');
    // }

    // public function mailVerifyReq(){
    //     return view('frontend.auth.mail.verify-mail-request');
    // }

    // public function mailVerifyAgain(Request $request){
    //     $customer = CustolerLogin::where('email',$request->email)->firstOrFail();
    //     CustomerEmailVerify::where('customer_id',$customer->id)->delete();

    //     $customerToken = CustomerEmailVerify::create([
    //         'customer_id'=>$customer->id,
    //         'token'=>uniqid(),
    //         'created_at'=>Carbon::now(),
    //     ]);
    //     Notification::send($customer, new CustomerEmailVerifyNotification($customerToken));
    //     return back()->withReqsend('We have sent you a Email Verify link! please check your email');
    // }
}
