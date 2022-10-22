<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Salesmans;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Salesman\CreateSalesmanRequest;
use App\Models\Salesman;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateSalesmanController extends AbstractAPIController
{
    public function __invoke(CreateSalesmanRequest $request): JsonResource
    {
        $data = $request->all([
            'is_active',
            'salesman_code',
            'salesman_name',
            'notes',
            'quota',
        ]);

        $data['created_by'] = $this->getUser()->getId();

        return new JsonResource(Salesman::create($data));
    }
}
