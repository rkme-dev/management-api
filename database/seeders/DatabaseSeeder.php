<?php


declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AbilitiesSeeder::class,
            RolesSeeder::class,
        ]);
        $this->call(DocumentsTableSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(UnitPackingsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
