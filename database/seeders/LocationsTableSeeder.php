<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('locations')->delete();

        \DB::table('locations')->insert([
            0 => [
                'id' => 1,
                'location_code' => 'Eco Group of Companies (Back Office)',
                'description' => 'Quezon City Office',
                'address' => 'Blk. 6 Lot 7 Almond St. Sherwood Heights Cor. Himlayan Rd. Pasong Tamo, Quezon City',
                'type' => 'Office',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => '2022-10-29 15:51:23',
                'updated_at' => '2022-10-29 15:51:23',
            ],
            1 => [
                'id' => 2,
                'location_code' => 'Main WH',
                'description' => 'Main Warehouse',
                'address' => 'Bulacan',
                'type' => 'Warehouse',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => null,
                'created_at' => '2022-11-07 19:45:15',
                'updated_at' => '2022-11-09 20:42:14',
            ],
        ]);
    }
}
