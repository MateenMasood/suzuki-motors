<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsPrices extends Model
{
    protected $table='products_prices';
    protected $guarded=[];


    public function productVersion()
    {
        return $this->belongsTo('App\Models\ProductVersion');
    }


}
