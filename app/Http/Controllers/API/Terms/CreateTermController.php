<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Terms;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Terms\CreateTermRequest;
use App\Models\Term;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateTermController extends AbstractAPIController
{
    public function __invoke(CreateTermRequest $request): JsonResource
    {
        $data = $request->all([
            'is_active',
            'code',
            'days',
            'description',
            'notes',
        ]);

        $data['created_by'] = $this->getUser()->getId();

        return new JsonResource(Term::create($data));
    }
}
