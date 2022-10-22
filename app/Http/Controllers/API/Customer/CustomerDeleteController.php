<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

final class CustomerDeleteController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $customer = Customer::find($id);
        $customer->delete();

        return $this->respondNoContent();
    }
}
