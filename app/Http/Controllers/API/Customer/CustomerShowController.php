<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

final class CustomerShowController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $customer = Customer::findOrFail($id);

        return $this->respondOK(['data' => $customer,]);
    }
}
