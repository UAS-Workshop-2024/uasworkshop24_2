<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'image';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = true;

    // public function I_product()
    // {
    //     return $this->belongsTo(Products::class, 'product_id', 'id');
    // }
}
