<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CategorySubcategoryProductController extends Controller
{
    public function categoryProduct($category_id){
        $category_name = Category::find($category_id);
        $category_products = Product::where('category_id', $category_id)->paginate('16');
        $subcategoryProducts = SubCategory::where('category_id', $category_id)->get();
        return view('frontend.page.category-product',[
            'category_products'=>$category_products,
            'category_name' => $category_name,
            'subcategoryProducts'=>$subcategoryProducts,
        ]);
    }

    public function subcategoryProduct($subcategoryId){
        $sucategory_name = Subcategory::find($subcategoryId);
       $subcategoryProducts = Product::where('subcategory_id',$subcategoryId)->paginate('16');
       return view('frontend.page.subcategoryProduct',[
        'subcategoryProducts'=>$subcategoryProducts,
        'sucategory_name' => $sucategory_name
       ]); 
    }

    function cart(Request $request)
    {
        $coupon = $request->coupon;
        $message = null;
        $type = null;

        if($coupon == ''){
            $discount = 0;
        }
        else {
            if(Coupon::where('name', $coupon)->exists()){
                if(Carbon::now()->format('Y-m-d') > Coupon::where('name', $coupon)->first()->expire){
                    $discount = 0;
                    $message = 'Coupon Code Expired!';
                }
                else{
                    $discount = Coupon::where('name', $coupon)->first()->discount;
                    $type = Coupon::where('name', $coupon)->first()->type;
                    
                } 
            }
            else{
                $discount = 0;
                $message = 'Invalid Coupon Code!';
            }
        }
        $carts = Cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.page.cart',[
            'carts'=>$carts,
            'message'=>$message,
            'discount'=>$discount,
            'type'=>$type,
        ]);
    }
}
