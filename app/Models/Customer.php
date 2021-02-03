<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded=[];

    public function enquiry()
    {
        return $this->hasMany('App\Models\Enquiry');

    }

    /**
     * Get the product hold for the customer.
     */
    public function productHold()
    {
        return $this->hasMany('App\Models\ProductHold');
    }
}
