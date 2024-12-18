<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishLists extends Model
{
    use HasFactory;
    protected $table = 'wish_lists';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function product()
	{
		return $this->belongsTo(Products::class);
	}

}
