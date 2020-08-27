<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Setting;
use App\Model\User\Order;
use App\Model\User\OrderDetail;
use App\Model\User\Shipping;
use Cart;
use Auth;
use Session;

class PaymentController extends Controller
{
    public function payment(Request $request){
        $category = Category::orderBy('category_name','ASC')->get();
        $setting = Setting::first();
        $cart = Cart::Content();
        $data = [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'city'=>$request->city,
            'payment'=>$request->payment,
        ];
        
        if($request->payment == 'stripe'){

            return view('pages.payment.stripe',compact('data','cart','category','setting'));

        }elseif($request->payment == 'paypal'){


        }elseif($request->payment == 'idle'){
            

        }else{
            echo 'Cash On Delivery';
        }

    }

    public function stripePayment(Request $request){
        $total= $request->total;
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51H1CFLBWYiAmbMxSY0zWjaHeG2jrkRzmrGxBnchd60D0M6sqsm7Rd69ts5ceQV70k3aFb4MFN0Ctc5wA4SiNEJ6f00CRFXd3mZ');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total*100,
        'currency' => 'inr',
        'description' => 'Simple Ecom Charge',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

        $order =[
            'user_id'=>Auth::id(),
            'payment_id'=>$charge->payment_method,
            'payment_type'=>$request->payment_type,
            'paying_amount'=>$charge->amount,
            'blnc_transaction'=>$charge->balance_transaction,
            'stripe_order_id'=>$charge->metadata->order_id,
            'shipping'=>$request->shipping_charge,
            'subtotal'=>$request->subtotal,
            'vat'=>$request->vat,
            'total'=>$request->total,
            'date'=>date('d-m-y'),
            'month'=>date('F'),
            'year'=>date('Y'),
            'status_code'=>mt_rand(100000,999999),
            'status'=>0
        ];
        $orderId = Order::insertGetId($order);
        
        //--Insert Record into shippings table--
        $ship = new Shipping();
        $ship->order_id = $orderId;
        $ship->ship_name = $request->ship_name;
        $ship->ship_phone = $request->ship_phone;
        $ship->ship_email = $request->ship_email;
        $ship->ship_address = $request->ship_address;
        $ship->ship_city = $request->ship_city;
        $ship->save();

        //--Insert Record into order_details table--
        $content = Cart::content();
        foreach($content as $row){
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $orderId;
            $orderDetail->product_id = $row->id;
            $orderDetail->product_name = $row->name;
            $orderDetail->size = $row->options->size;
            $orderDetail->color = $row->options->color;
            $orderDetail->quantity = $row->qty;
            $orderDetail->single_price = $row->price;
            $orderDetail->total_price = $row->price * $row->qty;
            $orderDetail->save();
        }

        Cart::destroy();
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        $notification=array(
            'messege'=>'Order Process Successfully Done',
            'alert-type'=>'success'
        );
        return Redirect()->to('/')->with($notification); 
        

        
    }
}
