<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventories extends Model
{
    use HasFactory;
    protected $table = 'product_inventories';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public function Pi_product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
