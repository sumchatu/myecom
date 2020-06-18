<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];
    
    public function getRouteKeyName(){
        return 'slug';
    }

    protected static function boot(){
        parent::boot();

        static::creating(function ($coupon){
            $coupon->slug = str_slug($coupon->coupon_name);
        });
    }
}
