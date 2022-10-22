<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Vats;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Vats\UpdateVatRequest;
use App\Models\Vat;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

final class UpdateVatController extends AbstractAPIController
{
    public function __invoke(UpdateVatRequest $request, int $id)
    {
        $data = $request->all([
            'is_active',
            'code',
            'name',
            'percentage',
            'notes'
        ]);

        $vat = Vat::find($id);

        if ($request->get('code') !== $vat->code) {
            $exist = Vat::where('code', $request->get('code'))->first();

            if ($exist !== null) {
                return Response::json(array(
                    'code' => 'Vat code already exist.',
                ), 422);
            }
        }

        if ($request->get('name') !== $vat->name) {
            $exist = Vat::where('name', $request->get('name'))->first();

            if ($exist !== null) {
                return Response::json(array(
                    'name' => 'Vat name already exist.',
                ), 422);
            }
        }

        $data['updated_by'] = $this->getUser()->getId();

        $vat->update($data);

        $vat->refresh();

        return new JsonResource($vat);
    }
}
