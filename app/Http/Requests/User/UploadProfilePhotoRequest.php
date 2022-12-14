<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\UploadedFile;

final class UploadProfilePhotoRequest extends BaseRequest
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
            'file' => 'required',
        ];
    }
}
