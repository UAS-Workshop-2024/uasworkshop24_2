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

    public function Sm_order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function Sm_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Sm_user_by()
    {
        return $this->belongsTo(User::class, 'shipped_by', 'id');
    }
}
