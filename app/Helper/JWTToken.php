<?php
namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
use Faker\Extension\Extension;

class JWTToken{

    public static function CreateToken($userEmail,$userID):string{//open close solid principle//agile a kaj korle solid

        $key=env('JWT_KEY');
        $payload=[
            'iss'=>"laravel-token",
            'iat'=>time(),
            'exp'=>time()+60*60,
            'userEmail'=>$userEmail,
            'userID'=>$userID
        ];
        return JWT::encode($payload,$key,'HS256');
    } 

    public static function ReadToken($token){

        try {
            if($token==null){
                return 'unauthorized';
            }
            else{
                $key =env('JWT_KEY');
                return JWT::decode($token,new Key($key,'HS256'));
            }
        }
        catch (Exception $e){
            return 'unauthorized';
        }
    }
  
}