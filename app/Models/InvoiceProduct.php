<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    use HasFactory;
    protected $fillable=['qty','sale_price','product_id','invoice_id','user_id'];

    function product(){
      return $this->belongsTo(Product::class);
    }
}

