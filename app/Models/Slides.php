<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    use HasFactory;
    protected $table = 'slides';
    protected $primaryKey = 'id';
    protected $guarded = [

    ];

    public function Sl_user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
