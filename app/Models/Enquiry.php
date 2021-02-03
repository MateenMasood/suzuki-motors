<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
     /**
     * Get the ProductVersion that owns the enquiry.
     */
    public function ProductVersion()
    {
        return $this->belongsTo('App\Models\ProductVersion');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');

    }
}
