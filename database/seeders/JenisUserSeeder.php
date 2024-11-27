<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class JenisUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_user')->insert([
            [
                'id_jenis_user' => 1,
                'jenis_user' => 'Admin',
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
            [
                'id_jenis_user' => 2,
                'jenis_user' => 'User',
                'create_by' => 'System',
                'created_at' => Carbon::now(),
                'delete_mark' => 0,
                'update_by' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
