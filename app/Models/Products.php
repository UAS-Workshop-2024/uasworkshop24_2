<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public function Pr_image()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function Pr_orderitem()
    {
        return $this->hasMany(OrderItems::class, 'product_id', 'id');
    }

    public function Pr_PAV()
    {
        return $this->hasMany(ProductAttributeValues::class, 'product_id', 'id');
    }

    public function Pr_PI()
    {
        return $this->hasOne(ProductInventories::class, 'product_id', 'id');
    }

    public function Pr_wishlist()
    {
        return $this->hasMany(WishLists::class, 'product_id', 'id');
    }

    public function Pr_user()
    {
        return $this->belongsTo(user::class, 'product_id', 'id');
    }
}
