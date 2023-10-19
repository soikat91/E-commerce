<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerDetail;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileCreate(Request $request){
        
        $user_id=$request->header('id');
        $request->merge(['user_id'=>$user_id]);
        $data=CustomerDetail::updateOrCreate(
            ['user_id'=>$user_id],
            $request->input()
        );

        return ResponseHelper::out('success',$data,200);

    }

    public function readProfile(Request $request){

        $user_id=$request->header('id');
        $data=CustomerDetail::where('user_id',$user_id)->first();
        return ResponseHelper::out('success',$data,200);
    }
}
