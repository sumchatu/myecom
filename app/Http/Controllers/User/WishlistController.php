<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Model\User\Wishlist;
use App\User;
use App\Model\Admin\Category;

use Illuminate\Http\Request;
use Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('category_name','ASC')->get();
        $user =User::find(Auth::id());
        
        return view('pages.wishlist',compact('user','category'));
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
        $userId = Auth::id();
        $data = [
            'user_id' => $userId,
            'product_id' => $request->product_id
        ];
        $check = Wishlist::where('user_id',$userId)->where('product_id',$request->product_id)->first();

        if(Auth::check()){
            if($check){
                return \Response::json(['error'=>'Product Allready Added into Your Wishlist']);
            }else{
                Wishlist::create($data);
                return \Response::json(['success'=>'Product Added on wishlist']);
            }
        }else{
            return \Response::json(['error'=>'At First Login into Your Account']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\User\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\User\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\User\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
