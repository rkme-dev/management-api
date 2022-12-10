<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Exceptions\InvalidResourceTypeException;
use App\Http\Resources\Resource;
use App\Models\User;
use Silber\Bouncer\Database\Role;

final class UserResource extends Resource
{
    /**
     * @throws InvalidResourceTypeException
     */
    protected function getResponse(): array
    {
        if (($this->resource instanceof User) === false) {
            throw new InvalidResourceTypeException(
                User::class
            );
        }

        $role = $this->resource->getRoles()[0] ?? null;

        $role = Role::where('name', $role)->first();

        $user = $this->resource;

        $employeeId = \str_pad((string) $user->getId(), 8, '0', STR_PAD_LEFT);

        $employeeId = sprintf('EMP-%s', $employeeId);

        return [
            'id' => $user->getId(),
            'name' => \sprintf('%s %s %s',
                $user->first_name,
                $user->middle_name,
                $user->last_name
            ),
            'employee_number' => $employeeId,
            'first_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'email' => $this->resource->email,
            'department_id' => $user->department_id,
            'access_level_id' => $user->access_level_id,
            'status' => ucfirst($this->resource->status),
            'role' => $role?->title,
            'role_id' => $role?->id,
            'gender' => $user->gender,
            'employment_type' => $user->employment_type,
            'designation' => $user->designation,
            'profile_url' => $user->profile_url,
            'valid_id_url' => $user->valid_id_url,
            'pagibig' => $user->pagibig,
            'tin' => $user->tin,
            'emergency_contact_address' => $user->emergency_contact_address,
            'emergency_contact_name' => $user->emergency_contact_name,
            'emergency_contact_number' => $user->emergency_contact_number,
            'birth_date' => $user->birth_date,
            'date_hired' => $user->date_hired,
            'abilities' => $this->resource->getAbilities(),
            'ability_names' => array_column($this->resource->getAbilities()->toArray() ?? [], 'name'),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
