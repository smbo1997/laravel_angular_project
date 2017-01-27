<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use Stripe\Stripe;
use Validator;
use Stripe\Charge;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showform(Request $request)
    {
        return view('payform');
    }

    public function paywithcard(Request $request)
    {

        Stripe::setApiKey('sk_test_c6ez6wXp0A7XafR8GXwUMNMh ');

        try{
            Charge::create(array(
                "amount" => $request->total * 100,
                "currency" => "usd",
                "source" => $request->stripeToken, // obtained with Stripe.js
                "description" => "Test Charge"
            ));

        }
        catch (\Exception $e){
            return redirect()->route('pay')->with('error',$e->getMessage());
        }

        return redirect('pay');

    }


    public function insertdata(Request $request){
       $insert_id =  Post::insertGetId([
           'productname'=>$request->productname,
           'productsize'=>$request->productsize,
           'price'=>$request->price,
        ]);

       if($insert_id){
           return response(['id'=>$insert_id]);
       }
    }


    public function deleteproduct(Request $request)
    {
       $delete =  Post::where('id', $request->productid)->delete();

       if($delete){
           return response(['data'=>true]);
       }
    }

    public function updateproduct(Request $request)
    {
       $updateproduct =  Post::where('id', $request->productid)
                                     ->update(['productname' => $request->productname, 'productsize'=>$request->productsize,'price'=>$request->price]);

        if($updateproduct){
            return response(['data'=>true]);
        }
    }

    public function carusel(){
        return view('carusel');
    }

    public function upload(){
        return view('imageupload');
    }
}
