<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function categoryList(){
        
       $category= Category::get();

       return ResponseHelper::out('success',$category,200);//helper  function theke out function asce static method
    }
   
}
