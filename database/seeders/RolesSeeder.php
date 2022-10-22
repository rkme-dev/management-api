<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserStatusesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\Bouncer;
use Silber\Bouncer\Database\Ability;

final class RolesSeeder extends Seeder
{
    private Bouncer $bouncer;

    public function __construct(Bouncer $bouncer) {
        $this->bouncer = $bouncer;
    }

    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@enco.com',
            'gender' => 'male',
            'password' => Hash::make('letmein'),
            'is_active' => true,
            'status' => UserStatusesEnum::ACTIVE->value,
        ]);

        $roleFactory = $this->bouncer->role();

        $roleFactory->firstOrCreate([
            'name' => 'superadmin',
            'title' => 'Super Admin',
        ]);

        $ability = Ability::where('name', '*')->first();

        $this->bouncer->allow('superadmin')->to($ability);

        $user->assign('superadmin');
    }
}
