<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CacheLocks extends Model
{
    use HasFactory;
    protected $table = 'cache_locks';
    protected $primaryKey = 'key';
    protected $guarded = [
        
    ];
}
