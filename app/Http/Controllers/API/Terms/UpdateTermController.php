<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Terms;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Terms\UpdateTermRequest;
use App\Models\Term;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Response;

final class UpdateTermController extends AbstractAPIController
{
    public function __invoke(UpdateTermRequest $request, int $id)
    {
        $data = $request->all([
            'is_active',
            'code',
            'days',
            'description',
            'notes'
        ]);

        $term = Term::find($id);

        if ($request->get('code') !== $term->code) {
            $exist = Term::where('code', $request->get('code'))->first();

            if ($exist !== null) {
                return Response::json(array(
                    'code' => 'Term code already exist.',
                ), 422);
            }
        }

        $data['updated_by'] = $this->getUser()->getId();

        $term->update($data);

        $term->refresh();

        return new JsonResource($term);
    }
}
