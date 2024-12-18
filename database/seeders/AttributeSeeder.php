<?php

namespace Database\Seeders;

use App\Models\Attributes;
use App\Models\AttributeOptions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AttributeColor = Attributes::create([
            'id' => 1,
            'code' => 'color',
            'name' => 'color',
            'type' => 'select'
        ]);
        $AttributeSize = Attributes::create([
            'id' => 2,
            'code' => 'size',
            'name' => 'size',
            'type' => 'select'
        ]);

        AttributeOptions::create([
            'name' => 'hijau',
            'attribute_id' => $AttributeColor->id
        ]);
        AttributeOptions::create([
            'name' => 'biru',
            'attribute_id' => $AttributeColor->id
        ]);
        AttributeOptions::create([
            'name' => '40',
            'attribute_id' => $AttributeSize->id
        ]);
        AttributeOptions::create([
            'name' => '20',
            'attribute_id' => $AttributeSize->id
        ]);
    }
}
