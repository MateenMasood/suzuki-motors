<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];

    public function order_relation()
    {
        return $this->hasOne('App\Models\OrderRelation');
    }

    public function order_item()
    {
        return $this->hasOne('App\Models\OrderItem');
    }

    public function order_charge()
    {
        return $this->hasMany('App\Models\OrderCharge');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Payment');
    }
    public function docs()
    {
        return $this->hasMany('App\Models\OrderDoc');
    }
}
