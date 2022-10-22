<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductionProcedureRequestStatusesEnum: string
{
    case PENDING_REQUEST = 'pending request';

    case RELEASED = 'released';
}
