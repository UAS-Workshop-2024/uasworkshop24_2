<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishLists extends Model
{
    use HasFactory;
    protected $table = 'wish_lists';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public function W_product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function W_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
