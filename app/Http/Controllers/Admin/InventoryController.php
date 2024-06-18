<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function inventory($id){
        $inventories = Inventory::where('product_id',$id)->get();
        return view('admin.product.inventory',[
            'colors' => Color::all(),
            'sizes' => Size::all(),
            'inventories'=>$inventories,
            'product' => Product::find($id)
        ]);
    }
    public function inventoryStore(Request $request){
        Inventory::create([
            'product_id'=>$request->product_id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
        ]);
        return back()->with('success','inventory add success!');
    }
    public function inventoryDelete($id){
        $id = Inventory::find($id);
        $id->delete();
        return back()->with('success','inventory delete success!');
    }
}
