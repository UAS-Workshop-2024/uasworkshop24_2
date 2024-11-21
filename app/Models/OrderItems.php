<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public function Oi_order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function Oi_product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

}
