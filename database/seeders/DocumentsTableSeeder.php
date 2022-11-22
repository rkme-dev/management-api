<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('documents')->delete();
        
        \DB::table('documents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'document_name' => 'Purchase Order',
                'module' => 'Purchase Order',
                'description' => 'Purchase Order',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-10-29 16:29:44',
                'updated_at' => '2022-10-29 16:31:30',
            ),
            1 => 
            array (
                'id' => 3,
                'document_name' => 'Sales Order',
                'module' => 'Orders',
                'description' => 'Sales Order Form',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-10-29 16:34:45',
                'updated_at' => '2022-10-29 16:35:54',
            ),
            2 => 
            array (
                'id' => 4,
                'document_name' => 'Trip Ticket',
                'module' => 'Trip-ticket',
                'description' => 'Trip Ticket',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-10-29 16:36:20',
                'updated_at' => '2022-10-29 16:36:20',
            ),
            3 => 
            array (
                'id' => 5,
                'document_name' => 'Collections',
                'module' => 'Collection',
                'description' => 'Collection Form',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-10-29 16:36:45',
                'updated_at' => '2022-10-29 16:36:45',
            ),
            4 => 
            array (
                'id' => 6,
                'document_name' => 'Deposit Slip',
                'module' => 'Deposit',
                'description' => 'Deposit',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-10-29 16:37:11',
                'updated_at' => '2022-10-29 16:37:11',
            ),
            5 => 
            array (
                'id' => 8,
                'document_name' => 'DR',
                'module' => 'Sales',
                'description' => 'Delivery Receipt',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-11-04 18:18:49',
                'updated_at' => '2022-11-04 18:18:49',
            ),
            6 => 
            array (
                'id' => 9,
                'document_name' => 'Sales Invoice',
                'module' => 'Sales',
                'description' => 'Sales Invoice',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-11-04 18:19:07',
                'updated_at' => '2022-11-04 18:19:07',
            ),
            7 => 
            array (
                'id' => 7,
                'document_name' => 'Bounced Checks',
                'module' => 'Bounced',
                'description' => 'Bounced Checks',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-11-02 20:14:47',
                'updated_at' => '2022-11-07 19:18:09',
            ),
            8 => 
            array (
                'id' => 10,
                'document_name' => 'Physical',
                'module' => 'Physical',
                'description' => 'Physical count',
                'notes' => NULL,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2022-11-09 20:36:34',
                'updated_at' => '2022-11-09 20:36:34',
            ),
            9 => 
            array (
                'id' => 2,
                'document_name' => 'Order',
                'module' => 'Sales',
                'description' => 'Sales Order',
                'notes' => NULL,
                'is_active' => false,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => NULL,
                'created_at' => '2022-10-29 16:31:52',
                'updated_at' => '2022-11-09 22:46:11',
            ),
        ));
        
        
    }
}