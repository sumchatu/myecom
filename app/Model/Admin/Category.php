<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Model\Admin\Subcategory;
use App\Model\Admin\Product;

class Category extends Model
{
    protected $fillable = [
        'category_name','slug'
    ];

    protected static function boot(){
        parent::boot();

        static::creating(function ($category){
            $category->slug = str_slug($category->category_name);
        });
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
