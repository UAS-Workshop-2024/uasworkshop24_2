<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu')->insert([
            [
                'menu_id' => 1,
                'menu_name' => 'Management Jenis User',
                'menu_link' => 'jenisUser.show',
                'menu_icon' => 'fa-dashboard',
                'parent_id' => null,
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
            [
                'menu_id' => 2,
                'menu_name' => 'Management User',
                'menu_link' => 'user.show',
                'menu_icon' => 'fa-users',
                'parent_id' => null,
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
            [
                'menu_id' => 3,
                'menu_name' => 'Management Menu',
                'menu_link' => 'menu.show',
                'menu_icon' => 'fa-cogs',
                'parent_id' => null,
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
            [
                'menu_id' => 4,
                'menu_name' => 'Setting Menu User',
                'menu_link' => 'menuUser.show',
                'menu_icon' => 'fa-user',
                'parent_id' => 2,
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
