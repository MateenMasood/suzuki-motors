<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVersion extends Model
{
    protected $guarded=[];

    /**
     * Get the product that owns the productVersions.
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Get the enquiry record associated with the product.
     */
    public function enquiry()
    {
        return $this->hasOne('App\Models\Enquiry');
    }


}
