<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Line;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Line\CreateLineRequest;
use App\Models\Line;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateLineController extends AbstractAPIController
{
    public function __invoke(CreateLineRequest $request, int $id): JsonResource
    {
        $line =  Line::find($id);

        $data = $request->all('name', 'description', 'procedure_type');

        $line->update(
            [
                ...$data,
                [
                    'updated_by' => $this->getUser()->getId(),
                ],
            ],
        );

        return new JsonResource($line);
    }
}
