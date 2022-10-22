<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Documents;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Document;

final class DeleteDocumentController extends AbstractAPIController
{
    public function __invoke(int $id)
    {
        $document = Document::find($id);

        $document->update([
            'is_active' => 0,
        ]);

        return $this->respondNoContent();
    }
}
