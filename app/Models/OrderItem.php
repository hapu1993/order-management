<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = array('order_id', 'product_id', 'customer_id', 'qty', 'item_price','date');


    function product()
    {
        return $this->belongsTo(Product::class);
    }

    function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    function order()
    {
        return $this->belongsTo(Order::class);
    }
}
