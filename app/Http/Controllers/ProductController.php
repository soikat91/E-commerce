<?php

namespace App\Http\Controllers;

use App\Models\ProductWish;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\ProductSlider;
use App\Helper\ResponseHelper;
use App\Models\CustomerDetail;
use App\Models\ProductCart;
use App\Models\ProductDetails;
use function Laravel\Prompts\select;

class ProductController extends Controller
{
    
    function listProductByCategory(Request $request){
        
        $data=Product::where('category_id',$request->id)->with('category','brand')->get();
        
        return ResponseHelper::out('success',$data,200); 

    }

    function listProductByBrand(Request $request){

        $data=Product::where('brand_id',$request->id)->with('brand','category')->get();
        
        return ResponseHelper::out('success',$data,'200');

    }

    function listProductByRemark(Request $request){
        
        $data=Product::where('remark',$request->remark)->with('brand','category')->get();
        return ResponseHelper::out('success',$data,'200');
    }

    function listProductSlider(Request $request){

        $data=ProductSlider::all();
        return ResponseHelper::out('success',$data,200);
    }
    function listProductDetails(Request $request){
        $data=ProductDetails::where('product_id',$request->id)->with('product','product.brand','product.category')->get();
        return ResponseHelper::out('success',$data,200);
    }

    function ProductReview(Request $request){
        $data=ProductReview::where('product_id',$request->product_id)
        ->with(['profile'=>function($query)
        {$query->select('id','cus_name');}])
        ->get();
        return ResponseHelper::out('success',$data,200);
    }

    function createReview(Request $request){

        $user_id=$request->header('id');
        $profile=CustomerDetail::where('user_id',$user_id)->first();//first customer profile ace kina ta check dilm
        if($profile){//jdi profile thake tahle ei sob ghotbe

                $request->merge(['customer_id'=>$profile->id]);
                $data=ProductReview::updateOrCreate(
                    ['customer_id'=>$profile->id,'product_id'=>$request->product_id],//customer id mane hocce profile er id 
                    $request->input()
                );
                return ResponseHelper::out('success',$data,200);
        }else{

            return ResponseHelper::out('failed',"Profile Data not exits",200);
        }
        
    }

    function productWish(Request $request){

            $user_id=$request->header('id');
            $data=ProductWish::where('user_id',$user_id)->get();
            return ResponseHelper::out('success',$data,200);
    }
    function productWishCreate(Request $request){

        $user_id=$request->header('id');
        
        $data=ProductWish::updateOrCreate(
            ['user_id'=>$user_id,'product_id'=>$request->product_id],
            ['user_id'=>$user_id,'product_id'=>$request->product_id]
        );
        return ResponseHelper::out('success',$data,200);

    }

    function productWishRemove(Request $request){

        $user_id=$request->header('id');

        $data=ProductWish::where('user_id',$user_id)->where('product_id',$request->product_id)->delete();
        return ResponseHelper::out('success',$data,'200');

    }

    function cartCreate(Request $request){

        $user_id=$request->header('id');
        $product_id=$request->input('product_id');
        $color=$request->input('color');
        $size=$request->input('size');
        $qty=$request->input('qty');

        $unitPrice=0;
        $productDetails=Product::where('id',$product_id)->first();

        if($productDetails->discount_price==1){
            $unitPrice=$unitPrice+$productDetails->discount_price;
        }else{
            $unitPrice=$unitPrice+$productDetails->price;
        }
        $totalPrice=$qty*$unitPrice;

        $data=ProductCart::updateOrCreate(
            ['user_id'=>$user_id,'product_id'=>$product_id],
            [
                'color'=>$color,
                'size'=>$size,
                'qty'=>$qty,
                'price'=>$totalPrice
                
            ]
            );
        return ResponseHelper::out('Success',$data,'200');


    }

    public function cartList(Request $request){

        $user_id=$request->header('id');
        $data=ProductCart::where('user_id',$user_id)->with('product')->get();
        return ResponseHelper::out('Success',$data,'200');
    }
    
    public function productRemoveCart(Request $request){

        $user_id=$request->header('id');
        $data=ProductCart::where('user_id',$user_id)->where('product_id',$request->product_id)->delete();
        return ResponseHelper::out('Success',$data,'200');

    }


}
