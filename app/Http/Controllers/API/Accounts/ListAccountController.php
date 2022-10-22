<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Accounts;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Account;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListAccountController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(Account::all());
    }
}
