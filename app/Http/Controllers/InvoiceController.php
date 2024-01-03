<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use Exception;
use App\Models\Invoice;
use App\Helper\SSLCommerz;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use App\Models\CustomerDetail;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    function invoiceCreate(Request $request){

        DB::beginTransaction(); //multiple table a data insert krar jnno db begian transation use kra hoice
        try{

            $userId=$request->header('id');
            $userEmail=$request->header('email');
            $tran_id=uniqid();
            $delivery_status="Pending";
            $payment_status="Pending";
            
            $profile=CustomerDetail::where('user_id',$userId)->first();
            $cus_details="Name:$profile->cus_name,Address:$profile->cus_city,City:$profile->cus_city";
            $ship_details="Name:$profile->ship_name,Address:$profile->ship_address,City:$profile->ship_city";

            // payable calculation
            $total=0;

            $productCart=ProductCart::where('user_id',$userId)->get();
            foreach($productCart as $value){

                $total=$total+$value->price;
            }
            $vat=($total*3)/100;
            $payable=$total+$vat;

            $invoice=Invoice::create([
                'total'=>$total,
                'vat'=>$vat,
                'payable'=>$payable,
                'cus_details'=>$cus_details,
                'ship_details'=>$ship_details,
                'tran_id'=>$tran_id,               
                'delivery_status'=>$delivery_status,
                'payment_status'=>$payment_status,
                'user_id'=>$userId           
                
             
            ]);

            $invoiceId=$invoice->id;

            foreach($productCart as $eachProduct){
                
                InvoiceProduct::create([
                    'qty'=>$eachProduct['qty'],
                    'sale_price'=>$eachProduct['price'],                 
                    'product_id'=>$eachProduct['product_id'],
                    'invoice_id'=>$invoiceId,
                    'user_id'=>$userId
                ]);

            }
            
            $paymentMethod=SSLCommerz::InitiatePayment($profile,$payable,$tran_id,$userEmail);

            DB::commit();

            return ResponseHelper::out("success",array(['paymentMethid'=>$paymentMethod,'total'=>$total]),200);
            
        }catch(Exception $e){

            DB::rollBack();

            return ResponseHelper::out('failed',$e,200);

        }
    }

    function invoiceList(Request $request){

        $userId=$request->header('id');
        
        $invoiceList=Invoice::where('user_id',$userId)->get();

        return ResponseHelper::out('success',$invoiceList,200);

    }

    function invoiceProductList(Request $request){

        $userId=$request->header('id');       

        return InvoiceProduct::where('user_id',$userId)->where('invoice_id',$request->invoice_id)->with('product')->get();
       

    }

    function paymentSuccess(Request $request){
        
       return SSLCommerz::paymentSuccess($request->query('tran_id'));///query string diye tran_id pass kora hoice oi kranone akne query use kora hoice
    }

    function paymentCancel(Request $request){

       return SSLCommerz::paymentCancel($request->query('tran_id'));
    }

    function paymentFail(Request $request){

       return SSLCommerz::paymentFail($request->query('tran_id'));

    }

    function paymentIpn(Request $request){
       return SSLCommerz::paymentIpn($request->input('tran_id'),$request->input('status'),$request->input('val_id'));

    }
}
