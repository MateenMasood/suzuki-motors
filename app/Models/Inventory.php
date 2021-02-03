<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $guarded=[];

    public function productVersion()
    {
        return $this->belongsTo('App\Models\ProductVersion');
    }

    /**
     * Get the product hold for the inventory.
     */
    public function productHold()
    {
        return $this->hasOne('App\Models\ProductHold');
    }

    /**
     * Get the product hold for the inventory.
     */
    public function inventoryInfo()
    {
        return $this->hasMany('App\Models\InventoryInfo');
    }
}
