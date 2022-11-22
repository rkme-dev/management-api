<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('terms')->delete();
        
        \DB::table('terms')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '15 Days',
                'days' => '15',
                'description' => '15 Days Terms',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2022-10-28 08:21:46',
                'updated_at' => '2022-10-28 08:21:46',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => '30 Days',
                'days' => '30',
                'description' => '30 Days Terms',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2022-10-28 08:22:10',
                'updated_at' => '2022-10-28 08:22:10',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => '7 Days',
                'days' => '7',
                'description' => '7 Days Terms',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2022-10-28 09:05:31',
                'updated_at' => '2022-10-28 09:05:31',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => '60 Days',
                'days' => '60',
                'description' => '60 Days Terms',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2022-10-28 09:07:18',
                'updated_at' => '2022-10-28 09:07:18',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'CASH',
                'days' => '0',
                'description' => 'CASH ONLY',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2022-11-22 14:11:14',
                'updated_at' => '2022-11-22 14:11:14',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}