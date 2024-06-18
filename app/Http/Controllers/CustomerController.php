<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\CustolerLogin;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;

class CustomerController extends Controller
{
    public function profile(){
        return view('frontend.page.customer-profile');
    }

    public function profileUpdate(Request $request){
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'country'=>$request->country,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
        $profile = CustolerLogin::find(Auth::guard('customerlogin')->id());

        if($request->password == ''){
            if($request->photo == ''){
                $profile->update($data);
                return back();
            }
            else{
                //image delete if exists
                if($profile->photo){
                    if(file_exists('uploads/customer/'.$profile->photo)){
                        unlink(public_path('uploads/customer/'.$profile->photo));  
                    }
                }
                //image upload
                $image = $request->file('photo');
                $imageName = Auth::guard('customerlogin')->id().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/uploads/customer/'), $imageName);
                $data['photo'] = $imageName;

                $profile->update($data);
                return back();
            }
        }
        else {
            if(Hash::check($request->old_password,Auth::guard('customerlogin')->user()->password)){
                $data['password'] = bcrypt($request->password);
                if($request->photo == ''){
                    $profile->update($data);
                    return back();
                }
                else{
                    //image delete if exists
                    if($profile->photo){
                        if(file_exists('uploads/customer/'.$profile->photo)){
                            unlink(public_path('uploads/customer/'.$profile->photo));  
                        }
                    }
                    //image upload
                    $image = $request->file('photo');
                    $imageName = Auth::guard('customerlogin')->id().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('/uploads/customer/'), $imageName);
                    $data['photo'] = $imageName;
    
                    $profile->update($data);
                    return back();
                }
            }
            else{
                return back()->with('failled','current password is wrong!');
            }
        }
    }

    //invoice-download
    public function downloadInvoice($order_id){
        $order_info = Order::find($order_id);
        $billing_info = BillingDetails::where('order_id',$order_info->order_id)->get();
        $order_product = OrderProduct::where('order_id',$order_info->order_id)->get();
        $invoice = PDF::loadView('invoice.download-invoice', [
            'order_info'=>$order_info,
            'billing_info'=>$billing_info,
            'order_product'=>$order_product,
        ]);
        return $invoice->download('invoice.pdf');
    }

    //review
    public function reviewStore(Request $request){
        $orderProduct = OrderProduct::where('customer_id', $request->customer_id)
                    ->where('product_id', $request->product_id)
                    ->first();

            if ($orderProduct) {
                $orderProduct->update([
                    'review' => $request->review,
                    'star' => $request->star,
                ]);
            }
            return back();
    }

}
