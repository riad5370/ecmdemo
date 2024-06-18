<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function productVariation(){
        return view('admin.product.variation',[
            'sizes'=>Size::all(),
            'colors'=>Color::all()
        ]);
    }

    public function variationStore(Request $request){
        $optionName = $request->input('option_name');
        $optionValue = $request->input('option_value');

    if ($optionName === 'color') {
        
        // Insert into Color model
        Color::create([
            'name' => $optionValue,
            'color_code' => $request->color_code,
        ]);
    } elseif ($optionName === 'size') {
        // Insert into Size model
        Size::create(['name' => $optionValue]);
    }

    return back()->with('success', 'saved successfully!');
    }
    public function variationDelete(Request $request){
        $sizeDelete = $request->input('delete1');
        $colorDelete = $request->input('delete2');
       if($sizeDelete){
        $sizeId = Size::find($request->id);
        $sizeId->delete();
        return back()->with('success', 'Your Record Has been deleted');
       }
       elseif ($colorDelete){
        $sizeId = Color::find($request->id);
        $sizeId->delete();
        return back()->with('success', 'Your Record Has been deleted');
       }
    }
}
