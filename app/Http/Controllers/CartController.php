<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function cartStore(Request $request){
        if(Auth::guard('customerlogin')->id()){
          $var = Inventory::where('product_id', $request->product_id)->first();
          if($var && $var->color_id !== null && $var->size_id !== null ){
            $request->validate([
               'color_id'=>'required',
               'size_id'=>'required',
               'quantity'=>'required',
            ]);
          }
            $quantity = Inventory::where('product_id', $request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first();

            if($quantity && $quantity->quantity >= $request->quantity){
                if(Cart::where('product_id',$request->product_id)->where('customer_id',Auth::guard('customerlogin')->id())->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
                  //inventory and cart existing check
                  $existingQuantity = Cart::where('product_id', $request->product_id)
                     ->where('customer_id', Auth::guard('customerlogin')->id())
                     ->where('color_id', $request->color_id)
                     ->where('size_id', $request->size_id)
                     ->sum('quantity');
                   $newQuantity = $existingQuantity + $request->quantity;

                   $inventoryy = Inventory::where('product_id', $request->product_id)
                   ->where('color_id', $request->color_id)
                   ->where('size_id', $request->size_id)
                   ->sum('quantity');

                   if($newQuantity <= $inventoryy){
                   Cart::where('product_id',$request->product_id)->where('customer_id',Auth::guard('customerlogin')->id())->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
                   return back()->with('success','Cart update Successfull');
                  }else {
                     return back()->with('error', 'Insufficient inventory. Unable to update cart.');
                 }
                   
                }
                else{
                   Cart::insert([
                      'customer_id'=>Auth::guard('customerlogin')->id(),
                      'product_id'=>$request->product_id,
                      'color_id'=>$request->color_id,
                      'size_id'=>$request->size_id,
                      'quantity'=>$request->quantity,
                      'created_at'=>Carbon::now(),
                   ]);
                   return back()->with('success','Cart Added Successfull');
                }
             }
             else{
                return back()->with('stock','out of stock, total stock:'.($quantity ? $quantity->quantity : ''));
             }
        }
        else {
            return Redirect::route('customer.signup')->with('warning','Please Login To Add Card');
       }
    }
   public function remove($id){
      cart::find($id)->delete();
      return back();
   }

   //cart-update
   public function cartUpdate(Request $request){
      $carts = $request->all();
      foreach($carts['quantity'] as $cart_id=>$quantity){
        cart::find($cart_id)->update([
            'quantity'=>$quantity,
        ]);
      }
      return back();
   }
   
}
