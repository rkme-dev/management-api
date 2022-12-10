<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
//        \DB::table('accounts')->delete();

        \DB::table('accounts')->insert([
            0 => [
                'account_code' => 'Enco-Inventory',
                'account_title' => 'Enco-Inventory',
                'type' => 'Asset',
                'normal' => 'D',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_at' => null,
                'created_at' => '2022-11-24 15:17:58',
                'updated_at' => '2022-11-24 15:37:09',
            ],
            1 => [
                'account_code' => 'CIB-Savings',
                'account_title' => 'CIB-Savings',
                'type' => 'Bank',
                'normal' => 'C',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => '2022-11-24 20:04:18',
                'updated_at' => '2022-11-24 20:04:18',
            ],
            2 => [
                'account_code' => 'CIB-PNB',
                'account_title' => 'Cash In Bank - PNB',
                'type' => 'Bank',
                'normal' => 'D',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => '2022-11-24 20:04:48',
                'updated_at' => '2022-11-24 20:04:48',
            ],
            3 => [
                'account_code' => 'Accounts Receivable',
                'account_title' => 'Accounts Receivable',
                'type' => 'Accounts Receivable',
                'normal' => 'C',
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => '2022-11-24 20:05:15',
                'updated_at' => '2022-11-24 20:05:15',
            ],
        ]);
    }
}
