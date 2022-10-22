<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Documents;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Terms\CreateTermRequest;
use App\Models\Document;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowDocumentController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        return new JsonResource(Document::find($id));
    }
}
