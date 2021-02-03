<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtendedWarranty extends Model
{
    protected $guarded=[];

    public function productVersion()
    {
        return $this->belongsTo('App\Models\ProductVersion');
    }
}
