<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    protected $fillable = array('reference', 'status');
    function orders()
    {
        return $this->hasMany(Order::class);
    }
}
