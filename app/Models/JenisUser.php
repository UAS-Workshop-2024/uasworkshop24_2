<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUser extends Model
{
    use HasFactory;
    protected $table = 'jenis_user';
    protected $primaryKey = 'id_jenis_user';
    protected $guarded = [

    ];

    public function settingsMenuUser()
{
    return $this->hasMany(SettingMenuUser::class, 'id_jenis_user');
}
    public function user()
    {
        return $this->hasMany(User::class, 'id_jenis_user', 'id_jenis_user');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'setting_menu_user', 'id_jenis_user', 'menu_id');
    }
}
