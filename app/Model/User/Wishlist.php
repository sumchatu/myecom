<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Model\Admin\Product;

class Wishlist extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
