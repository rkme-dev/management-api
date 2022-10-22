<?php

declare(strict_types=1);

namespace App\Enums;

enum UserStatusesEnum: string
{
    case ACTIVE = 'Active';

    case DEACTIVATED = 'Deactivated';

    case DELETED = 'Deleted';

    case INACTIVE = 'Inactive';

    case PENDING = 'Pending';
}
