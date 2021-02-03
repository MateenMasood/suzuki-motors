<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     /**
     * Get the user that owns the employee.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the branch that owns the employee.
     */
    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');

    }
}
