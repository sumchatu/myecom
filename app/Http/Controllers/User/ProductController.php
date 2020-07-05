<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use App\Model\Admin\Product;
use Cart;


class ProductController extends Controller
{
    public function productDetails($id,$product_name){
        $category = Category::orderBy('category_name','ASC')->get();
        $product = Product::find($id);

        $color = $product->product_color;
        $product_color = explode(',',$color);

        $size = $product->product_size;
        $product_size = explode(',',$size);

        return view('pages.product_details',compact('category','product','product_color','product_size'));
    }

    //--For getting the subcategory wise all products
    public function subcatProducts($subcat_id){
        $category = Category::orderBy('category_name','ASC')->get();
        $subcat = Subcategory::find($subcat_id);
        $allProduct = Product::where('subcategory_id',$subcat_id)->where('status',1);
        $products = $allProduct->paginate(10);

        $brands = $allProduct->get()->map(function($product){
            return $product->brand;
        });
        return view('pages.subcat_all_products',compact('category','products','subcat','brands'));
    }

    //--For getting the category wise all products
    public function categoryProducts($category_id){
        $category = Category::orderBy('category_name','ASC')->get();
        $cat = Category::find($category_id);
        $allProduct = Product::where('category_id',$category_id)->where('status',1);
        $products = $allProduct->paginate(10);

        $brands = $allProduct->get()->map(function($product){
            return $product->brand;
        });
        return view('pages.category_all_products',compact('category','products','cat','brands'));
    }

    // --- For getting the product details by Ajax from index-page for quick view of product
    public function productQuickDetails($id){
        $product = Product::find($id);

        $color = $product->product_color;
        $product_color = explode(',',$color);

        $size = $product->product_size;
        $product_size = explode(',',$size);

        return response()->json([
            'product' => $product,
            'product_category' => $product->category->category_name,
            'product_subCategory' => $product->subcategory->subcategory_name,
            'product_brand' => $product->brand->brand_name,
            'color' => $product_color,
            'size' => $product_size
        ]);

    }

    public function addToCart(Request $request){
        $product = Product::find($request->product_id);
        $data = [];
        if($product->discount_price == NULL){
            $data['id']= $product->id;
            $data['name']= $product->product_name;
            $data['qty']= $request->qty;
            $data['price']= $product->selling_price;
            $data['weight']= 1;
            $data['options']['color']= $request->color;
            $data['options']['size']= $request->size;
            $data['options']['image']= $product->image_one;
                Cart::add($data);
            $notification=array(
                'messege'=>'Product Successfully Added to Cart!',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }else{
            $data['id']= $product->id;
            $data['name']= $product->product_name;
            $data['qty']= $request->qty;
            $data['price']= $product->discount_price;
            $data['weight']= 1;
            $data['options']['color']= $request->color;
            $data['options']['size']= $request->size;
            $data['options']['image']= $product->image_one;
                Cart::add($data);
            $notification=array(
                'messege'=>'Product Successfully Added to Cart!',
                'alert-type'=>'success'
                );
            return Redirect()->back()->with($notification);
        }
    }

    
}
