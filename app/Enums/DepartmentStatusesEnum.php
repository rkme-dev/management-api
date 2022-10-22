<?php

declare(strict_types=1);

namespace App\Enums;

enum DepartmentStatusesEnum: string
{
    case ACTIVE = 'Active';

    case DEACTIVATED = 'Deactivated';

    case PENDING = 'Pending';
}
