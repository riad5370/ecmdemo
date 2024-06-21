<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Thumbnail;
use App\Models\Thumnail;
use App\Models\Wishlish;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Cookie;
use Arr;

class FrontendController extends Controller
{
    public function index(){
        //cookies
        $resent_viewed_product = json_decode(Cookie::get('recent_view'), true);

        if ($resent_viewed_product == null) {
            $resent_viewed_product = [];
        }

        $after_unique = array_unique($resent_viewed_product);
        $resent_viewed_products = Product::whereIn('id', $after_unique)
                                 ->orderByDesc('created_at')
                                 ->limit(4)
                                 ->get();


        
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $products = Product::orderBy('created_at', 'desc')->paginate(18);
        $recentsProducts = Product::orderBy('created_at', 'desc')->limit(4)->get();

        $best_selling_product = OrderProduct::groupBy('product_id')
        ->selectRaw('sum(quantity) as sum, product_id')
        ->orderBy('quantity','Desc')
        ->havingRaw('sum >= 1')
        ->get();
        return view('frontend.index',[
            'products'=>$products,
            'best_selling_product'=>$best_selling_product,
            'categories' => $categories,
            'resent_viewed_product'=>$resent_viewed_products,
            'subcategories'=>$subcategories,
            'recentsProducts'=>$recentsProducts,
            'brands'=> Brand::all(),
        ]);
    }

    public function categoryProduct($category_id){
        $category_name = Category::find($category_id);
        $category_products = Product::where('category_id', $category_id)->paginate('16');
        $subcategoryProducts = Subcategory::where('category_id', $category_id)->get();
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

    public function details($slug){
        $product_info = Product::where('slug',$slug)->first();

        $related_products = Product::where('category_id', $product_info->category_id)->where('id', '!=', $product_info->id)->get();

        $thamnails = Thumnail::where('product_id',$product_info->id)->get();
        $availabe_colors = Inventory::where('product_id', $product_info->id)
        ->groupBy('color_id')
        ->selectRaw('count(*) as total, color_id')->get();

        //customer-review
        $reviews = OrderProduct::where('product_id',$product_info->id)->whereNotNull('review')->get();
        $total_review = OrderProduct::where('product_id',$product_info->id)->whereNotNull('review')->count();
        $total_star = OrderProduct::where('product_id',$product_info->id)->whereNotNull('review')->sum('star');

        //product-size
        $sizes = Size::all();

        //cookies
        $product_id = $product_info->id;
        $al = Cookie::get('recent_view');
        if(!$al){
            $al = "[]";
        }
        $all_info = json_decode($al,true);
        $all_info = Arr::prepend($all_info,$product_id);
        $recent_product_id = json_encode($all_info);
        Cookie::queue('recent_view',$recent_product_id, 1000);

        return view('frontend.page.details',[
            'product_info'=>$product_info,
            'thamnails'=>$thamnails,
            'availabe_colors'=>$availabe_colors,
            'sizes'=>$sizes,
            'related_products'=>$related_products,
            'reviews'=> $reviews,
            'total_review'=>$total_review,
            'total_star'=>$total_star
        ]);
    }
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
        $carts = cart::where('customer_id', Auth::guard('customerlogin')->id())->get();
        return view('frontend.page.cart',[
            'carts'=>$carts,
            'message'=>$message,
            'discount'=>$discount,
            'type'=>$type,
        ]);
    }
    //customer-order-page 
    public function myOrder(){
        $myorders = Order::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('frontend.page.my-order',compact('myorders'));
    }

    ///wishlist
    public function wishlist(){
        $wishlists = Wishlish::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('frontend.page.wishlist',[
            'wishlists'=>$wishlists
        ]);
    }
}
