<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Documents;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Documents\CreateDocumentRequest;
use App\Models\Document;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateDocumentController extends AbstractAPIController
{
    public function __invoke(CreateDocumentRequest $request): JsonResource
    {
        $data = $request->all([
            'is_active',
            'module',
            'document_name',
            'description',
            'notes',
        ]);

        $data['created_by'] = $this->getUser()->getId();

        return new JsonResource(Document::create($data));
    }
}
