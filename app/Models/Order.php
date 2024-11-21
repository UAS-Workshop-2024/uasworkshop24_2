<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public function O_approvedby()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }

    public function O_cancelledby()
    {
        return $this->belongsTo(User::class, 'cancelled_by', 'id');
    }

    public function O_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function O_orderitem()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }

    public function O_payment()
    {
        return $this->hasOne(Payments::class, 'order_id', 'id');
    }

    public function O_shipments()
    {
        return $this->hasOne(Shipments::class, 'order_id', 'id');
    }
}
