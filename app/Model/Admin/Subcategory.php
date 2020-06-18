<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Model\Admin\Category;
use App\Model\Admin\Product;

class Subcategory extends Model
{
    protected $guarded = [];

    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    
}
