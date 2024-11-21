<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValues extends Model
{
    use HasFactory;
    protected $table = 'product_attribute_values';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public function Pav_attributes()
    {
        return $this->belongsTo(Attributes::class, 'attribute_id', 'id');
    }

    public function Pav_product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
