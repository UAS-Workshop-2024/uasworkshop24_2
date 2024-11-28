<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    use HasFactory;
    protected $table ='shipments';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public const PENDING = 'pending';
    public const SHIPPED = 'shipped';

    public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
