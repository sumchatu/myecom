<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

use App\Model\Admin\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $brand  = Brand::all();

        return view('admin.category.brand',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
        ]);

        $image_url = '';
        
       if ($files = $request->file('brand_logo')) {
            request()->validate([
                'brand_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
       	// Define upload path
           $destinationPath = public_path('/media/brand/'); // upload path
		// Upload Orginal Image           
           $image_url = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $image_url);
        }

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->slug = str_slug($request->brand_name);
        $brand->brand_logo = $image_url;
        $brand->save();

        $notification=array(
            'messege'=>'Brand Added Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.category.brand_edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        /*$validateData = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
        ]);*/

        $image_url = $brand->brand_logo;
        
       if ($files = $request->file('brand_logo')) {
            request()->validate([
                'brand_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if(\File::exists(public_path('/media/brand/'.$brand->brand_logo)))
            {
                \File::delete(public_path('/media/brand/'.$brand->brand_logo));
            }

       	 // Define upload path
           $destinationPath = public_path('/media/brand/'); // upload path
		 // Upload Orginal Image           
           $image_url = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $image_url);
        }

        $brand->brand_name = $request->brand_name;
        $brand->slug = str_slug($request->brand_name);
        $brand->brand_logo = $image_url;
        $brand->update();

        $notification=array(
            'messege'=>'Brand updated Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->route('brand.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if(\File::exists(public_path('/media/brand/'.$brand->brand_logo)))
        {
            \File::delete(public_path('/media/brand/'.$brand->brand_logo));
        }

        $brand->delete();

        $notification=array(
            'messege'=>'Brand Deleted Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
}
