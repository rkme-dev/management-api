<?php

declare(strict_types=1);

namespace App\Enums;

enum ReleaseOrderStatusesEnum: string
{
    case PENDING_REQUEST = 'pending_request';

    case RELEASED = 'released';

    case RECEIVED = 'received';

    case CANCELLED = 'cancelled';
}
