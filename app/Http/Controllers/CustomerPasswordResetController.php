<?php

namespace App\Http\Controllers;

use App\Models\CustolerLogin;
use App\Models\CustomerPassReset;
use App\Notifications\CustomerPassResetNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CustomerPasswordResetController extends Controller
{
    public function index(){
        return view('frontend.auth.forgot-password');
    }
    public function passResetRequest(Request $request){
        $customerInfo = CustolerLogin::where('email', $request->email)->firstOrFail();
        CustomerPassReset::where('guest_id',$customerInfo->id)->delete();
       
        $customerInsert = CustomerPassReset::create([
            'guest_id'=>$customerInfo->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($customerInfo, new CustomerPassResetNotification($customerInsert));
        return back()->withReqsend('We have sent you a password reset link! please check your email');
    }
    public function passResetForm($token){
        if(CustomerPassReset::where('token', $token)->exists()){
            return view('frontend.auth.pass-reset-form',[
                'token'=>$token
            ]);
        }
        else{
            abort('404');
        }
        
    }
    public function passwordReset(Request $request){
        $guest_info = CustomerPassReset::where('token',$request->token)->firstOrFail();
        CustolerLogin::findOrFail($guest_info->guest_id)->update([
            'password'=>bcrypt($request->password)
        ]);
        $guest_info->delete();
        return redirect()->route('customer.signup')->withResetsucces('Password Reset Successfully please login');
    }
}
