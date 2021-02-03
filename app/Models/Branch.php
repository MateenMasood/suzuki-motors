<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded=[];

    public function employee()
    {
        return $this->hasMany('App\Models\Employee');

    }


}