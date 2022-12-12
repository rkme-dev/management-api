<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductUnitPackingTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_unit_packing')->delete();

        \DB::table('product_unit_packing')->insert([
            0 => [
                'id' => 3,
                'packing' => '24',
                'product_id' => 1,
                'unit_packing_id' => 1,
                'actual_balance' => '100000',
                'reserved_balance' => '100000',
            ],
            1 => [
                'id' => 4,
                'packing' => '24',
                'product_id' => 2,
                'unit_packing_id' => 1,
                'actual_balance' => '100000',
                'reserved_balance' => '100000',
            ],
            2 => [
                'id' => 1,
                'packing' => '24',
                'product_id' => 3,
                'unit_packing_id' => 1,
                'actual_balance' => '100000',
                'reserved_balance' => '100000',
            ],
            3 => [
                'id' => 2,
                'packing' => '24',
                'product_id' => 4,
                'unit_packing_id' => 1,
                'actual_balance' => '100000',
                'reserved_balance' => '100000',
            ],
        ]);
    }
}
