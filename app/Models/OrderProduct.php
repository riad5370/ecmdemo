<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
    function color(){
        return $this->belongsTo(Color::class,'color_id');
    }
    function rel_to_customer(){
        return $this->belongsTo(CustolerLogin::class,'customer_id');
    }
    
}
