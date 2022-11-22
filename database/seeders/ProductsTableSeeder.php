<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'cool-pure-350ml',
                'supplier_id' => NULL,
                'name' => 'Cool & Pure 350ml',
                'sku' => 'CP-0001',
                'description' => NULL,
                'attachments' => NULL,
                'value' => NULL,
                'active' => true,
                'type' => 'finished_product',
                'created_at' => '2022-10-28 08:43:53',
                'updated_at' => '2022-10-28 08:43:53',
                'raw_material_type' => NULL,
                'price' => '204',
                'unit_id' => 1,
                'brand' => 'Cool & Pure Purified Drinking Water',
                'grouping' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'cool-pure-600ml',
                'supplier_id' => NULL,
                'name' => 'Cool & Pure 600ml',
                'sku' => 'CP-0002',
                'description' => NULL,
                'attachments' => NULL,
                'value' => NULL,
                'active' => true,
                'type' => 'finished_product',
                'created_at' => '2022-10-28 08:45:37',
                'updated_at' => '2022-10-28 08:45:37',
                'raw_material_type' => NULL,
                'price' => '252',
                'unit_id' => 1,
                'brand' => 'Cool & Pure Purified Drinking Water',
                'grouping' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'slug' => 'cool-pure-1000ml',
                'supplier_id' => NULL,
                'name' => 'Cool & Pure 1000ml',
                'sku' => 'CP-0003',
                'description' => NULL,
                'attachments' => NULL,
                'value' => NULL,
                'active' => true,
                'type' => 'finished_product',
                'created_at' => '2022-10-28 08:46:28',
                'updated_at' => '2022-10-28 08:46:28',
                'raw_material_type' => NULL,
                'price' => '262.5',
                'unit_id' => 1,
                'brand' => 'Cool & Pure Purified Drinking Water',
                'grouping' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'slug' => 'cool-pure-1500ml',
                'supplier_id' => NULL,
                'name' => 'Cool & Pure 1500ml',
                'sku' => 'CP-0004',
                'description' => NULL,
                'attachments' => NULL,
                'value' => NULL,
                'active' => true,
                'type' => 'finished_product',
                'created_at' => '2022-10-28 08:49:08',
                'updated_at' => '2022-10-28 08:49:08',
                'raw_material_type' => NULL,
                'price' => '264',
                'unit_id' => 1,
                'brand' => 'Cool & Pure Purified Drinking Water',
                'grouping' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}