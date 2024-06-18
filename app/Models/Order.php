<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    function rel_to_customer(){
        return $this->belongsTo(CustolerLogin::class,'customer_id');
         
    }
}
