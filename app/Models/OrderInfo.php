<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
