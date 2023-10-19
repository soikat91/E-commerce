<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable=['product_id','customer_id','description','rating'];

    function profile(){
        return $this->belongsTo(CustomerDetail::class,'customer_id');
    }

    function product(){
        return $this->belongsTo(Product::class);
    }
}
