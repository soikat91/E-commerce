<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;
    protected $fillable=['product_id','user_id','color','size','qty','price'];

    function product(){
        return $this->belongsTo(Product::class);
    }
}
