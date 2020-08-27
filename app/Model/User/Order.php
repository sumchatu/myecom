<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;
use App\Model\User\OrderDetail;
use App\Model\User\Shipping;
use App\User;

class Order extends Model
{
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }

    public function ship(){
        return $this->hasOne(Shipping::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
