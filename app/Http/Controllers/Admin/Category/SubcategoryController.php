<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

use App\Model\Admin\Subcategory;
use App\Model\Admin\Category;
use Illuminate\Http\Request;
use Crypt;

class SubcategoryController extends Controller
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
        $subcategory = Subcategory::all();
        $category = Category::all();

        return view('admin.category.subcategory',compact('subcategory','category'));
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
            'subcategory_name' => 'required|max:255',
            'category_id' => 'required',
        ]);

        // $store = $category->subcategories()->create($request->all());
        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->slug = str_slug($request->subcategory_name);
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        $notification=array(
            'messege'=>'Subcategory Added Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $subcategory = Subcategory::find($id);


      $categories = Category::orderBy('id','asc')->get();
      $categoryArr = ['' => 'Select Category'];
      foreach ($categories as $category):
          $categoryArr[$category->id] = $category->category_name;
      endforeach;

        return view('admin.category.subcategory_edit',compact('subcategory','categoryArr'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validateData = $request->validate([
            'subcategory_name' => 'required|max:255',
            'category_id' => 'required',
        ]);
        
        $subcategory->update(
            [
                'subcategory_name' => $request->subcategory_name,
                'slug' => str_slug($request->subcategory_name),
                'category_id' => $request->category_id
            ]
        );

        $notification=array(
            'messege'=>'Subcategory Updated Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->route('subcategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        $notification=array(
            'messege'=>'Subcategory Deleted Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
}
