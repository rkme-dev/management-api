<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\UploadedFile;

final class UserCreateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function getFile(): UploadedFile
    {
        return $this->file('file');
    }

    public function rules(): array
    {
        return [
            'role_id' => 'nullable|int',
            'email' => 'required|string|unique:App\Models\User,email||email:rfc,dns',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'first_name' => 'required|string',
            'middle_name' => 'string|nullable',
            'last_name' => 'required|string',
            'status' => 'required|string',
            'gender' => 'string|required',
            'employment_type' => 'string|nullable',
            'department_id' => 'int|required|exists:App\Models\Department,id',
            'access_level_id' => 'int|nullable',
            'designation' => 'string|nullable',
            'profile_url' => 'string|nullable',
            'valid_id_url' => 'string|nullable',
            'pagibig' => 'string|nullable',
            'sss' => 'string|nullable',
            'tin' => 'string|nullable',
            'emergency_contact_address' => 'string|nullable',
            'emergency_contact_name' => 'string|nullable',
            'emergency_contact_number' => 'string|nullable',
            'birth_date' => 'string|nullable',
            'date_hired' => 'string|nullable',
            'number' => 'string|nullable',
        ];
    }
}
