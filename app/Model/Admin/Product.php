<?php

namespace App\Model\Admin;

use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use App\Model\Admin\Brand;
use App\Model\User\OrderDetail;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function userOrderDetails($orderId){
        return $this->hasMany(OrderDetail::class)->where('order_id',$orderId);
    }
}
