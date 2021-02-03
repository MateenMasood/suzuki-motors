<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    /**
     * Get the bank that owns the branches.
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

     /**
     * Get the bank branchs for the dealers.
     */
    public function dealers()
    {
        return $this->hasMany('App\Models\Dealer');
    }
}
