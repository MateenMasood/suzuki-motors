<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductHold extends Model
{
    /**
     * Get the customers that owns the producthold.
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * Get the Inventory that owns the producthold.
     */
    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory');
    }
}
