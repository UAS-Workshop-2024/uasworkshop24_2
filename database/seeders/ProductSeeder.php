<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::create([
            'sku' => 'produk-sku',
            'type' => 'configurable',
            'name' => 'nama produk',
            'slug' => 'nama-produk',
            'user_id' => 3
        ]);
        Products::create([
            'sku' => 'product-sku-simple',
            'type' => 'simple',
            'name' => 'nama produk simple',
            'slug' => 'nama-produk-simple',
            'user_id' => 3
        ]);
    }
}
