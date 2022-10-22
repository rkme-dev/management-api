<?php

declare(strict_types=1);

namespace App\Enums;

enum WarehouseStatusesEnum: string
{
    case ACTIVE = 'Active';

    case DEACTIVATED = 'Deactivated';

    case INACTIVE = 'Inactive';

    case PENDING = 'Pending';
}
