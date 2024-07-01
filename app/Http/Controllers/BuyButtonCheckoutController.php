<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Mail\InvoiceMail;
use App\Models\BillingDetails;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;


class BuyButtonCheckoutController extends Controller
{
    public function buyNow(Request $request) {
        if (!Auth::guard('customerlogin')->check()) {
            return Redirect::route('customer.signup')->with('warning', 'Please Login To Add Cart');
        }
    
        $inventory = Inventory::where('product_id', $request->product_id)->first();
    
        if ($inventory && $inventory->color_id !== null && $inventory->size_id !== null) {
            $request->validate([
                'color_id' => 'required',
                'size_id' => 'required',
                'quantity' => 'required|integer|min:1',
            ]);
        }
    
        $quantityAvailable = Inventory::where([
            ['product_id', '=', $request->product_id],
            ['color_id', '=', $request->color_id],
            ['size_id', '=', $request->size_id]
        ])->first();
    
        if ($quantityAvailable && $quantityAvailable->quantity >= $request->quantity) {
            $product = Product::findOrFail($request->product_id);
            $size = Size::find($request->size_id);
            $color = Color::find($request->color_id);
    
            $total = $product->after_discount * $request->quantity;
            session(['total' => $total]);
    
            return view('frontend.page.buycheckout', [
                'product' => $product,
                'size' => $size,
                'color' => $color,
                'quantity' => $request->quantity,
            ]);
        } else {
            $stockMessage = $quantityAvailable ? 'out of stock, total stock: ' . $quantityAvailable->quantity : 'out of stock';
            return back()->with('stock', $stockMessage);
        }
    }

    public function buyNowCheckoutStore(Request $request){
      $request->validate([
          'name' => 'required|string',
          'email' => 'required|email',
          'mobile' => 'required|numeric',
          'address' => 'required|string',
          'charge' => 'required',
      ]);
      
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

         $product = Product::where('id',$request->product_id)->first();
      
          OrderProduct::insert([
              'order_id'=>$order_id,
              'customer_id'=>Auth::guard('customerlogin')->id(),
              'product_id'=>$request->product_id,
              'price'=>$product->after_discount,
              'color_id'=>$request->color_id,
              'size_id'=>$request->size_id,
              'quantity'=>$request->quantity,
              'created_at'=>Carbon::now(),
          ]);
          Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->decrement('quantity',$request->quantity);
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


