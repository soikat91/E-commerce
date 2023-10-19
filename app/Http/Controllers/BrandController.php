<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    function brandList(){

        $brand=Brand::get();
        
       return ResponseHelper::out("success",$brand,200);
    }
}
