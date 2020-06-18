<?php

namespace App\Model\Admin;

use App\Model\Admin\Product;

use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
    protected $guarded = [];
    
    public function getRouteKeyName(){
        return 'slug';
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
