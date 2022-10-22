<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Vats;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Vats\CreateVatRequest;
use App\Models\Vat;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateVatController extends AbstractAPIController
{
    public function __invoke(CreateVatRequest $request): JsonResource
    {
        $data = $request->all([
            'is_active',
            'code',
            'percentage',
            'name',
            'notes',
        ]);

        $data['created_by'] = $this->getUser()->getId();

        return new JsonResource(Vat::create($data));
    }
}
