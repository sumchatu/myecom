<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;
use App\Model\User\Order;

class Shipping extends Model
{
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
