<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OtherFrontendController extends Controller
{
    public function getsize(Request $request){

        $sizes = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str = '';

        foreach($sizes as $size){
            $str .= '<div class="form-check size-option form-option form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="size_id" id="'.$size->size->id.'" value="'.$size->size->id.'">
                <label class="form-option-label" for="'.$size->size->id.'">'.$size->size->name.'</label>
                </div>';
        }
        echo $str;
       
    }
    public function salesProduct(){
        $salesProduct = Product::whereNotNull('discount')->paginate('8');
        return view('frontend.page.salesProduct',[
            'salesProduct'=>$salesProduct
        ]);
    }
    public function signup(){
        return view('frontend.auth.customer-regi-login');
    }

    public function newRegister(){
        return view('frontend.auth.customerNewRegister');
    }
   
    //customer-order-page 
    public function myOrder(){
        $myorders = Order::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('frontend.page.my-order',compact('myorders'));
    }

    ///wishlist
    // public function wishlist(){
    //     $wishlists = Wishlish::where('customer_id',Auth::guard('customerlogin')->id())->get();
    //     return view('frontend.page.wishlist',[
    //         'wishlists'=>$wishlists
    //     ]);
    // }
}
