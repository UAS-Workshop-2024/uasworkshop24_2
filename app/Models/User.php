<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'user';

     protected $guarded = [

     ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function U_approvedby()
    {
        return $this->hasMany(Order::class, 'approved_by', 'id');
    }

    public function U_cancelledby()
    {
        return $this->hasMany(Order::class, 'cancelled_by', 'id');
    }

    public function U_order()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function U_product()
    {
        return $this->hasMany(Products::class, 'user_id', 'id');
    }

    public function U_shipment()
    {
        return $this->hasMany(Shipments::class, 'user_id', 'id');
    }

    public function U_shipment_by()
    {
        return $this->hasMany(Shipments::class, 'shipped_by', 'id');
    }

    public function U_slide()
    {
        return $this->hasMany(Slides::class, 'user_id', 'id');
    }

    public function U_wishlist()
    {
        return $this->hasMany(WishLists::class, 'user_id', 'id');
    }

    public function U_jenisu()
    {
        return $this->belongsTo(JenisUser::class, 'user_id', 'id');
    }
}
