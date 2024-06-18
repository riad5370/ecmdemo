<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function checkout(){
        $total_item = Cart::where('customer_id', Auth::guard('customerlogin')->id())->count();
        $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('frontend.page.checkout',[
            'total_item' => $total_item,
            'carts' => $carts,
        ]);
    }
    // public function getCity(Request $request){
    //     $cities = City::where('country_id',$request->country)->get();
    //      $str = '<option value="">-- Select City --</option>';
 
    //     foreach($cities as $city){
    //          $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
    //     }
    //     echo $str;
    // }

    public function store(Request $request){
        if($request->payment_method == 1){
            $order_id = '#'.Str::upper(Str::random(3)).'-'.rand(99999999,1000000000);

        Order::insert([
            'order_id'=>$order_id,
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'sub_total'=>$request->sub_total,
            'total'=>$request->sub_total + $request->charge,
            'discount'=>$request->discount,
            'charge'=>$request->charge,
            'payment_method'=>$request->payment_method,
            'created_at'=>Carbon::now(),
        ]);

        BillingDetails::insert([
            'order_id'=>$order_id,
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'zip'=>$request->zip,
            'created_at'=>Carbon::now(),
        ]);

        $carts = cart::where('customer_id',Auth::guard('customerlogin')->id())->get();

        foreach($carts as $cart){
            OrderProduct::insert([
                'order_id'=>$order_id,
                'customer_id'=>Auth::guard('customerlogin')->id(),
                'product_id'=>$cart->product_id,
                'price'=>$cart->product->after_discount,
                'color_id'=>$cart->color_id,
                'size_id'=>$cart->size_id,
                'quantity'=>$cart->quantity,
                'created_at'=>Carbon::now(),
            ]);
            Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity',$cart->quantity);
        }
        // send invoice mail
        Mail::to($request->email)->send(new InvoiceMail($order_id));
        
        //clear cart after order
        Cart::where('customer_id',Auth::guard('customerlogin')->id())->delete();

        $abc = substr($order_id, 1,13);
        return redirect()->route('order.success',$abc)->with('success','adaa');
        }
        else if($request->payment_method == 2) {
            $data = $request->all();
            return Redirect::route('pay')->with('data',$data);
        }
        else{
            $data = $request->all();
            return view('frontend.payment.stripe',[
                'data'=>$data,
            ]);
        }

        
    }
    public function orderSuccess($abc){
        if(session('success')){
            return view('frontend.page.order-success',[
                'order_id'=>$abc,
            ]);
        }
        else {
            abort(404);
        }
    }
}
