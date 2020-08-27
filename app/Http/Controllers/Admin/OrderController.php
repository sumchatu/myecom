<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function newOrder($status){
        if($status==0){
            $bladeTitle = 'Pending';
        }elseif($status==1){
            $bladeTitle = 'Payment Accepted';
        }elseif($status==2){
            $bladeTitle = 'Progressed';
        }elseif($status==3){
            $bladeTitle = 'Delivered';
        }else{
            $bladeTitle = 'Cancelled';
        }
        $order = Order::where('status',$status)->get();
        return view('admin.order.pending',compact('order','bladeTitle'));
    }

    public function orderDetails($orderId){
        $order = Order::find($orderId);
        return view('admin.order.viewOrderDetail',compact('order'));
    }

    public function orderAction($orderId,$action){
        $order = Order::find($orderId);
        $order->status = $action;
        $order->update();
        $message = '';
        if($action == 1){
            $message = 'Payment Accept Done';
        }elseif($action == 2){
            $message = 'Order sent for Delivery';
        }
        elseif($action == 5){
            $message = 'Order Cancelled';
        }

        $notification = array(
            'messege'=>$message,
            'alert-type'=>'success'
        );

        return Redirect()->route('admin.neworder',$action)->with($notification);
    }


}
