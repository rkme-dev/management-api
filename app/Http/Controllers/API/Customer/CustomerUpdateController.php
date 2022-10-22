<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

final class CustomerUpdateController extends AbstractAPIController
{
    public function __invoke(CustomerUpdateRequest $request, string $id): JsonResponse
    {
        $customer = Customer::find($id);
        $data = $request->all([
            'code',
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

        $data['updated_by'] = $this->getUser()->getId();

        $customer->update($data);

        return $this->respondOk([
            'data' => $customer,
        ]);
    }
}
