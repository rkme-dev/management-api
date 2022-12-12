<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Silber\Bouncer\Bouncer;

final class AbilitiesSeeder extends Seeder
{
    private Bouncer $bouncer;

    public function __construct(Bouncer $bouncer)
    {
        $this->bouncer = $bouncer;
    }

    public function run(): void
    {
        $this->bouncer->ability()->firstOrCreate([
            'name' => '*',
            'title' => 'All',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view-ability-list',
            'title' => 'View Abilities',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view-client-list',
            'title' => 'View Clients',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'create-client',
            'title' => 'Create Client',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view-client',
            'title' => 'View Client',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'update-client',
            'title' => 'Update Client',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'delete-client',
            'title' => 'Delete Client',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'create-user',
            'title' => 'Create User',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view-user',
            'title' => 'View User',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view-user-list',
            'title' => 'View Users',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'update-user',
            'title' => 'Update User',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'delete-user',
            'title' => 'Delete User',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'create-role',
            'title' => 'Create role',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view-role-list',
            'title' => 'View Roles',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view-role',
            'title' => 'View Role',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'update-role',
            'title' => 'Update Role',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'delete-role',
            'title' => 'Delete Role',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view list-purchase order',
            'title' => 'View Purchase Orders',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'create-purchase order',
            'title' => 'Create Purchase Order',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view for approval-purchase order',
            'title' => 'View Purchase Order - For Approval',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'approve-purchase order',
            'title' => 'Approve Purchase Order',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view approved-purchase order',
            'title' => 'View Approved Purchase Order',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'mark in transit-purchase order',
            'title' => 'Mark Purchase Order in Transit',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view in transit-purchase order',
            'title' => 'View Purchase Order In Transit',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view pier to warehouse-purchase order',
            'title' => 'View Purchase Order Pier to Warehouse',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'mark pier to warehouse-purchase order',
            'title' => 'Mark Purchase Order As Pier To Warehouse',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'view arrival-purchase order',
            'title' => 'View Purchase Order For Arrival',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'print-purchase order',
            'title' => 'Print Purchase Order',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'print barcode-purchase order',
            'title' => 'Print Barcode Purchase Order',
        ]);

        $this->bouncer->ability()->firstOrCreate([
            'name' => 'mark as arrived-purchase order',
            'title' => 'Mark Purchase Order As Arrived',
        ]);
    }
}
