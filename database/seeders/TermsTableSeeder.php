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

        \DB::table('terms')->insert([
            0 => [
                'id' => 1,
                'code' => '15 Days',
                'days' => '15',
                'description' => '15 Days Terms',
                'notes' => null,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => '2022-10-28 08:21:46',
                'updated_at' => '2022-10-28 08:21:46',
                'deleted_at' => null,
            ],
            1 => [
                'id' => 2,
                'code' => '30 Days',
                'days' => '30',
                'description' => '30 Days Terms',
                'notes' => null,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => '2022-10-28 08:22:10',
                'updated_at' => '2022-10-28 08:22:10',
                'deleted_at' => null,
            ],
            2 => [
                'id' => 3,
                'code' => '7 Days',
                'days' => '7',
                'description' => '7 Days Terms',
                'notes' => null,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => '2022-10-28 09:05:31',
                'updated_at' => '2022-10-28 09:05:31',
                'deleted_at' => null,
            ],
            3 => [
                'id' => 4,
                'code' => '60 Days',
                'days' => '60',
                'description' => '60 Days Terms',
                'notes' => null,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => '2022-10-28 09:07:18',
                'updated_at' => '2022-10-28 09:07:18',
                'deleted_at' => null,
            ],
            4 => [
                'id' => 5,
                'code' => 'CASH',
                'days' => '0',
                'description' => 'CASH ONLY',
                'notes' => null,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => '2022-11-22 14:11:14',
                'updated_at' => '2022-11-22 14:11:14',
                'deleted_at' => null,
            ],
        ]);
    }
}
