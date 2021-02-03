<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];


    /**
     * Get the product versions for the products.
     */
    public function productVersion()
    {
        return $this->hasMany('App\Models\ProductVersion');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }




}
