<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductionStatusesEnum: string
{
    case CREATED = 'created';

    case PENDING_RAW_MATERIALS_REQUEST = 'pending raw materials request';

    case PROCEDURE_IN_PROGRESS = 'procedure in progress';

    case PROCEDURE_DONE = 'procedure done';

    case RELEASED = 'released';
}
