<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitPackingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('unit_packings')->delete();
        
        \DB::table('unit_packings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Case',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2022-10-28 08:42:16',
                'updated_at' => '2022-10-28 08:42:16',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Bottles',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2022-10-28 08:42:34',
                'updated_at' => '2022-10-28 08:42:34',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}