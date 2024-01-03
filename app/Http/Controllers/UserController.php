<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use App\Mail\otpmail;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Exception;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

   function loginPage(){

      return view('pages.login-page');
   }

   function verifyPage(){
      return view('pages.verify-page');
   }


    public function userLogin(Request $request){

         try{
            $email=$request->email;
            $otp=rand(100000,999999);
            $details=['code'=>$otp];
            Mail::to($email)->send(new otpmail($details));
            User::updateOrCreate(['email'=>$email],['email'=>$email,'otp'=>$otp]);
            return ResponseHelper::out('success',"Your 6 degit OTP send",200);

         }catch(Exception $e){

            return ResponseHelper::out('failed',$e,200);

         }
            
            
    }

    public function loginVerify(Request $request){

            $userMail=$request->email;
            $otp=$request->otp;

            $verification=User::where('email',$userMail)->where('otp',$otp)->first();

            if($verification){

               User::where('email',$userMail)->where('otp',$otp)->update(['otp'=>'0']);
               $token=JWTToken::CreateToken($userMail,$verification->id);//mail and user er id pailo
               return ResponseHelper::out('success'," ",200)->cookie('token',$token,60*2*60);

            }else{

               return ResponseHelper::out('fail',null,200);
            }
    }

    function userLogOut(Request $request){

      return redirect('/')->cookie('token'," ",-1);
    }
}
