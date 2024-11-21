<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingMenuUser extends Model
{
    use HasFactory;
    protected $table = 'setting_menu_user';
    protected $primaryKey = 'no_setting';

    protected $guarded = [

    ];
    public function jenisUser()
    {
        return $this->belongsTo(JenisUser::class, 'id_jenis_user', 'id_jenis_user');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id_user', 'create_by');
    }
}
