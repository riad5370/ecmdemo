<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Thumnail;
use Cookie;
use Arr;

use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
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
}
