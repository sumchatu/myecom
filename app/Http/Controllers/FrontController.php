<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Admin\Newsletter;
use App\Model\Admin\Category;
use App\Model\Admin\Product;

class FrontController extends Controller
{
    public function index(){
        $category = Category::orderBy('category_name','ASC')->get();
        $bannerProduct = Product::where('status',1)->where('main_slider',1)->orderBy('id','Desc')->first();
        $featuredProduct = Product::where('status',1)->orderBy('id','Desc')->limit(8)->get();
        $buy1get1Product = Product::where('status',1)->where('buyone_getone',1)->orderBy('id','Desc')->limit(6)->get();
        $category1 = Category::skip(1)->first();
        $category2 = Category::skip(3)->first();
        $hotDealProduct = Product::where('status',1)->where('hot_deal',1)->orderBy('id','Desc')->limit(3)->get();
        $midSliderProduct = Product::where('status',1)->where('mid_slider',1)->orderBy('id','Desc')->limit(3)->get();
        
        return view('pages.index',compact('category','bannerProduct','featuredProduct','buy1get1Product','category1','category2','hotDealProduct','midSliderProduct'));
    }
    public function saveNewsLetter(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:newsletters|email',
        ]);

        $subscribe = Newsletter::create($request->all());

        $notification=array(
            'messege'=>'Thanks for subscribing us!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
}
