<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Setting;
use Illuminate\Http\Request;
use Image;

class SettingController extends Controller
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
        $setting = Setting::first();

        return view('admin.settings.index',compact('setting'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $logo = $request->shop_logo;

        if($logo){
            \File::delete(public_path('/media/logo/'.$setting->logo));
            $logo_name = hexdec(uniqid()). '.' .$logo->getClientOriginalExtension();
            Image::make($logo)->resize(100,100)->save('public/media/logo/'.$logo_name);

            $updateSetting = $setting->update(
                [
                    'shop_name' => $request->shop_name,
                    'logo' => $logo_name,
                    'email' => $request->email,
                    'phone_1' => $request->phone_1,
                    'phone_2' => $request->phone_2,
                    'facebook' => $request->facebook,
                    'youtube' => $request->youtube,
                    'instagram' => $request->instagram,
                    'twitter' => $request->twitter,
                    'vat' => $request->vat,
                    'shipping_charge' => $request->shipping_charge
                ]
            );
        }else{
            $updateSetting = $setting->update(
                [
                    'shop_name' => $request->shop_name,
                    'email' => $request->email,
                    'phone_1' => $request->phone_1,
                    'phone_2' => $request->phone_2,
                    'facebook' => $request->facebook,
                    'youtube' => $request->youtube,
                    'instagram' => $request->instagram,
                    'twitter' => $request->twitter,
                    'vat' => $request->vat,
                    'shipping_charge' => $request->shipping_charge
                ]
            );

        }
        $notification=array(
            'messege'=> 'Site Settings Updated Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->route('settings.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
