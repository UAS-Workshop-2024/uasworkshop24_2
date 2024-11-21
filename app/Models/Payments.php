<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $guarded = [ ];

    public function P_payment()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
