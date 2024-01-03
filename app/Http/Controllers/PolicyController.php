<?php

namespace App\Http\Controllers;

use App\Models\Plicy;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{


    function policyList(){

      return view('pages.policy-page');
    } 
      function getPolicy(Request $request){

        $type=$request->type;

        return Plicy::where('type',$type)->first();
      }


}
