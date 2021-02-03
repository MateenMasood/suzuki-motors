<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    /**
     * Get the bank that owns the dealer.
     */
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

    /**
     * Get the bankbranches that owns the dealer.
     */
    public function bankBranches()
    {
        return $this->belongsTo('App\Models\BankBranch' , 'id');
    }
}
