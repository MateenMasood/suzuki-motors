<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderRelation extends Model
{
    protected $guarded=[];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function enquiry()
    {
        return $this->belongsTo('App\Models\Enquiry');
    }

    public function extended_warranty()
    {
        return $this->belongsTo('App\Models\ExtendedWarranty');
    }

    public function insurance_program()
    {
        return $this->belongsTo('App\Models\InsuranceProgram');
    }

    public function registration_fee()
    {
        return $this->belongsTo('App\Models\RegistrationFee');
    }

    public function dealer()
    {
        return $this->belongsTo('App\Models\Dealer');
    }

    public function corporate()
    {
        return $this->belongsTo('App\Models\Corporate');
    }

    public function product_hold()
    {
        return $this->belongsTo('App\Models\ProductHold');
    }
}
