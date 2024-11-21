<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    protected $guarded = [

    ];

    public function settingMenus()
    {
        return $this->hasMany(SettingMenuUser::class, 'menu_id', 'menu_id');
    }
}
