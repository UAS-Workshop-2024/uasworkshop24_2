<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::create([
            'id' => 1,
            'name' => 'pakaian',
            'slug' => 'pakaian',
            'parent_id' => null
        ]);
        Categories::create([
            'id' => 2,
            'name' => 'pakaian laki-laki',
            'slug' => 'pakaian-laki-laki',
            'parent_id' => 1
        ]);
        Categories::create([
            'id' => 3,
            'name' => 'pakaian perempuan',
            'slug' => 'pakaian-perempuan',
            'parent_id' => 1
        ]);
    }
}
