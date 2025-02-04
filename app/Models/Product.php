<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = array('name', 'price', 'status');

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }
}
