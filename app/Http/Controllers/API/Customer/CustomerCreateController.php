<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Customer\CustomerCreateRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

final class CustomerCreateController extends AbstractAPIController
{
    public function __invoke(CustomerCreateRequest $request): JsonResponse
    {
        $data = $request->all([
            'name',
            'address',
            'delivery_address',
            'email',
            'contact_person',
            'contact_no',
            'tin',
            'credit_limit',
            'is_active',
            'is_bad_account',
            'salesman_id_1',
            'salesman_id_2',
            'area',
            'term_id',
            'vat_id',
            'type',
            'notes',
        ]);

        $data['code'] = $this->generateNumber(
            'customers',
            'CIF',
            'code',
            false
        );

        $data['created_by'] = $this->getUser()->getId();

        $customer = Customer::create($data);

        return $this->respondCreated([
            'data' => $customer,
        ]);
    }
}
