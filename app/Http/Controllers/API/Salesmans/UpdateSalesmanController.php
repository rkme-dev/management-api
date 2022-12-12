<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Salesmans;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Salesman\UpdateSalesmanRequest;
use App\Models\Salesman;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateSalesmanController extends AbstractAPIController
{
    public function __invoke(UpdateSalesmanRequest $request, int $id)
    {
        $data = $request->all([
            'is_active',
            'salesman_name',
            'quota',
            'notes',
        ]);

        $salesman = Salesman::find($id);

        $data['updated_by'] = $this->getUser()->getId();

        $salesman->update($data);

        $salesman->refresh();

        return new JsonResource($salesman);
    }
}
