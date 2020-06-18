<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;

use App\Model\Admin\Coupon;
use App\Model\Admin\Newsletter;
use Illuminate\Http\Request;

class CouponController extends Controller
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
        $coupon  = Coupon::all();

        return view('admin.coupon.coupon',compact('coupon'));
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
            'coupon_name' => 'required|unique:coupons|max:255',
            'coupon_discount' => 'required',

        ]);

        $coupon = Coupon::create($request->all());

        $notification=array(
            'messege'=>'Coupon Created Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.coupon_edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validateData = $request->validate([
            'coupon_name' => 'required|max:255',
            'coupon_discount' => 'required',
        ]);
        
        $coupon->update(
            [
                'coupon_name' => $request->coupon_name,
                'slug' => str_slug($request->coupon_name),
                'coupon_discount' => $request->coupon_discount,
            ]
        );

        $notification=array(
            'messege'=>'Coupon Updated Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->route('coupon.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        $notification=array(
            'messege'=>'Coupon Deleted Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    public function newsLetter(){
        $newsletter = Newsletter::all();

        return view('admin.coupon.newsletter',compact('newsletter'));
    }

    public function deleteNewsLetter($id){
        $newsletter = Newsletter::find($id)->delete();

        $notification=array(
            'messege'=>'Subscriber Deleted Successfully!',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }
}
