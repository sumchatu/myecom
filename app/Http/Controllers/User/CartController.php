<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Admin\Category;
use App\Model\Admin\Product;
use App\Model\Admin\Coupon;
use App\Model\Admin\Setting;
use Cart;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::find($request->product_id);

        $data = [];
        if($product->discount_price == NULL){
            $data['id']= $product->id;
            $data['name']= $product->product_name;
            $data['qty']= 1;
            $data['price']= $product->selling_price;
            $data['weight']= 1;
            $data['options']['color']= '';
            $data['options']['size']= '';
            $data['options']['image']= $product->image_one;
                Cart::add($data);
            return \Response::json(['success' => 'Product Successfully Added On Your Cart']);
        }else{
            $data['id']= $product->id;
            $data['name']= $product->product_name;
            $data['qty']= 1;
            $data['price']= $product->discount_price;
            $data['weight']= 1;
            $data['options']['color']= '';
            $data['options']['size']= '';
            $data['options']['image']= $product->image_one;
                Cart::add($data);
            return \Response::json(['success' => 'Product Successfully Added On Your Cart']);
        }
    }

    public function check(){
        $content = Cart::content();

        return response()->json($content);
    }

    public function showCart(){
        $category = Category::orderBy('category_name','ASC')->get();
        $cart = Cart::content();

        return view('pages.cart',compact('cart','category'));
    }

    public function deleteCartItem($rowId){
        Cart::remove($rowId);

        $notification=array(
            'messege'=>'Product Removed from Cart!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
    
    public function updateCartItem(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;

        Cart::update($rowId,$qty);

        $notification=array(
            'messege'=>'Product Quantity Updated!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);

    }

    public function checkout(){
        if(Auth::check()){
            $category = Category::orderBy('category_name','ASC')->get();
            $cart = Cart::content();
            $setting = Setting::first();

            return view('pages.checkout',compact('cart','category','setting'));

        }else{
            $notification=array(
                'messege'=>'Login Your Account First!',
                'alert-type'=>'error'
                );
            return Redirect()->route('login')->with($notification);
        }
    }

    public function coupon(Request $request){
        $coupon = $request->coupon;
        $checkCoupon = Coupon::where('coupon_name',$coupon)->first();

        if($checkCoupon){
            \Session::put('coupon',[
                'name'=>$checkCoupon->coupon_name,
                'discount'=>$checkCoupon->coupon_discount,
                'balance'=>Cart::Subtotal() - $checkCoupon->coupon_discount
            ]);
            $notification=array(
                'messege'=>'Succesfully Added Coupun',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }else{
            $notification=array(
                'messege'=>'Invalid Coupon',
                'alert-type'=>'error'
                );
            return Redirect()->back()->with($notification);
        }
    }

    public function removeCoupon(){
        \Session::forget('coupon');

        $notification=array(
            'messege'=>'Coupon Removed',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
}
