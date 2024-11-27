<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MenuUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setting_menu_user')->insert([
            [
                'no_setting' => 1,
                'id_jenis_user' => 1, // Admin
                'menu_id' => 1, // Jenis_user
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
            [
                'no_setting' => 2,
                'id_jenis_user' => 1, // Admin
                'menu_id' => 2, // Users
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
            [
                'no_setting' => 3,
                'id_jenis_user' => 1, // User
                'menu_id' => 3, // Dashboard
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
            [
                'no_setting' => 4,
                'id_jenis_user' => 1, // User
                'menu_id' => 4, // Settings
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
