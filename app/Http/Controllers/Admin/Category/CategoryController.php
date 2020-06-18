<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

use App\Model\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $category  = Category::all();

        return view('admin.category.category',compact('category'));
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
            'category_name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::create($request->all());

        $notification=array(
            'messege'=>'Category Added Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        
        return view('admin.category.category_edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validateData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);
        
        $category->update(
            [
                'category_name' => $request->category_name,
                'slug' => str_slug($request->category_name)
            ]
        );

        $notification=array(
            'messege'=>'Category Updated Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->route('category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $notification=array(
            'messege'=>'Category Deleted Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
}
