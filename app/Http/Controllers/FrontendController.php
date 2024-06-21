<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\SubCategory;

use Illuminate\Http\Request;


use Cookie;


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
   
}
