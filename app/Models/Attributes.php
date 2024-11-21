<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public function A_options()
    {
        return $this->hasMany(AttributeOptions::class, 'attribute_id', 'id');
    }

    public function A_PAV()
    {
        return $this->hasMany(ProductAttributeValues::class, 'attribute_id', 'id');
    }
}
