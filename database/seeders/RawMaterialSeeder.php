<?php

namespace Database\Seeders;

use App\Enums\ProductTypeEnums;
use App\Enums\RawMaterialTypeEnums;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RawMaterialSeeder extends Seeder
{
    public function run(): void
    {
        Product::firstOrCreate([
            'active' => true,
            'slug' => Str::slug('Blown Bottle'),
            'name' => 'Blown Bottle',
            'sku' => '',
            'description' => '',
            'in_stock' => '',
            'items_per_box' => 0,
            'raw_material_type' => RawMaterialTypeEnums::BLOWN_BOTTLE->value,
            'type' => ProductTypeEnums::RAW_MATERIAL->value,
        ]);
    }
}
