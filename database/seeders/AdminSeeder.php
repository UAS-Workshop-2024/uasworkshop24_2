<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'admin',
            'last_name' => '1',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123'),
            // 'is_admin' => true
            'id_jenis_user' => 1
        ]);
    }
}
