<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

final class CustomerListController extends AbstractAPIController
{
    public function __invoke(): JsonResponse
    {
        $customers = Customer::all();

        return $this->respondOK(
            [
                'data' => $customers,
            ]
        );
    }
}
