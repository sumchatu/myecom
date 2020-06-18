<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;

use App\Model\Admin\Product;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use App\Model\Admin\Brand;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use Image;
use Crypt;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id','DESC')->get();

        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('category_name','ASC')->get();
        $brand = Brand::orderBy('brand_name','ASC')->get();
        return view('admin.product.create',compact('category','brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if($image_one && $image_two && $image_three){
            $image_one_name = hexdec(uniqid()). '.' .$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);

            $image_two_name = hexdec(uniqid()). '.' .$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);

            $image_three_name = hexdec(uniqid()). '.' .$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);
        }

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->product_quantity = $request->product_quantity;
            $product->product_details = $request->product_details;
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand_id = $request->brand_id;
            $product->product_size = $request->product_size;
            $product->product_color = $request->product_color;
            $product->selling_price = $request->selling_price;
            $product->discount_price = $request->discount_price;
            $product->video_link = $request->video_link;
            $product->main_slider = $request->main_slider;
            $product->hot_deal = $request->hot_deal;
            $product->best_rated = $request->best_rated;
            $product->mid_slider = $request->mid_slider;
            $product->hot_new = $request->hot_new;
            $product->buyone_getone = $request->buyone_getone;
            $product->trend	 = $request->trend;
            $product->image_one = $image_one_name ;
            $product->image_two = $image_two_name ;
            $product->image_three = $image_three_name;
            $product->save();

            $notification=array(
                'messege'=>'Product Added Successfully!',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decrypt($id);
        $product = Product::find($id);

        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $product = Product::find($id);

        $category = Category::orderBy('category_name','ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name','ASC')->get();
        $brand = Brand::orderBy('brand_name','ASC')->get();

        return view('admin.product.edit',compact('product','category','subcategory','brand'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $updateProduct = $product->update(
            [
                'product_name' => $request->product_name,
                'product_code' => $request->product_code,
                'product_quantity' => $request->product_quantity,
                'product_details' => $request->product_details,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'brand_id' => $request->brand_id,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'video_link' => $request->video_link,
                'main_slider' => $request->main_slider,
                'hot_deal' => $request->hot_deal,
                'best_rated' => $request->best_rated,
                'mid_slider' => $request->mid_slider,
                'hot_new' => $request->hot_new,
                'buyone_getone' => $request->buyone_getone,
                'trend'	 => $request->trend,
            ]
        );

        $notification=array(
            'messege'=> 'Product Updated Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('product.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $image_one = \File::delete(public_path('/media/product/'.$product->image_one));
        $image_two = \File::delete(public_path('/media/product/'.$product->image_two));
        $image_three = \File::delete(public_path('/media/product/'.$product->image_three));
        
        $product->delete();

        $notification=array(
            'messege'=>'Product Deleted Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    public function fileUpdate(Request $request){
        $product = Product::find($request->product_id);

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if($image_one){
            \File::delete(public_path('/media/product/'.$product->image_one));
            $image_one_name = hexdec(uniqid()). '.' .$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);

            $product->update(['image_one'=>$image_one_name]);
            $message = 'Image One Updated Successfully';
        } 
        if($image_two){
            \File::delete(public_path('/media/product/'.$product->image_two));
            $image_two_name = hexdec(uniqid()). '.' .$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/media/product/'.$image_two_name);

            $product->update(['image_one'=>$image_two_name]);
            $message = 'Image Two Updated Successfully';
        } 
        if($image_three){
            \File::delete(public_path('/media/product/'.$product->image_three));
            $image_three_name = hexdec(uniqid()). '.' .$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/media/product/'.$image_three_name);

            $product->update(['image_one'=>$image_three_name]);
            $message = 'Image Three Updated Successfully';
        }

        $notification=array(
            'messege'=> $message,
            'alert-type'=>'success'
            );
        return Redirect()->route('product.index')->with($notification);
    }

    public function activateDeactivateProduct($id){

        $id = decrypt($id);
        $product = Product::find($id);

        if($product->status == 1){
            $product->status = 0;
            $product->update();
            $message = 'Product Deactivated Successfully!';
        }else{
            $product->status = 1;
            $product->update();
            $message = 'Product Activated Successfully!';
        }

        $notification=array(
            'messege'=> $message,
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    // For show subcategories by Ajax in product add page
    public function getSubcategories($category_id){
        $cat = Category::find($category_id);
        $subcat = $cat->subcategories;

        return json_encode($subcat);
    }
}
