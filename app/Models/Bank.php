<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
     /**
     * Get the dealers for the banks.
     */
    public function dealers()
    {
        return $this->hasMany('App\Models\Dealer');
    }

     /**
     * Get the branches for the banks.
     */
    public function bankBranches()
    {
        return $this->hasMany('App\Models\BankBranch');
    }
}
