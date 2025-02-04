<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = array('ref_no', 'order_date', 'status', 'upload_id');


    function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')->withPivot('item_price', 'qty','customer_id','date');
    }

    function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
}
