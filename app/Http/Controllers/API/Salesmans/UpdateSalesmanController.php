<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Salesmans;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Salesman\UpdateSalesmanRequest;
use App\Models\Salesman;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

final class UpdateSalesmanController extends AbstractAPIController
{
    public function __invoke(UpdateSalesmanRequest $request, int $id)
    {
        $data = $request->all([
            'is_active',
            'salesman_code',
            'salesman_name',
            'quota',
            'notes'
        ]);

        $salesman = Salesman::find($id);

        if ($request->get('salesman_code') !== $salesman->salesman_code) {

            $exist = Salesman::where('salesman_code', $request->get('salesman_code'))->first();

            if ($exist !== null) {
                return Response::json(array(
                    'salesman_code' => 'Salesman code already exist.',
                ), 422);
            }
        }

        $data['updated_by'] = $this->getUser()->getId();

        $salesman->update($data);

        $salesman->refresh();

        return new JsonResource($salesman);
    }
}
