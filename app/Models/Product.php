<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    function brand(){

       return $this->belongsTo(Brand::class);
    }
    function category(){
        return $this->belongsTo(Category::class);
    }
}
