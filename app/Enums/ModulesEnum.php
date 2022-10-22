<?php

declare(strict_types=1);

namespace App\Enums;

enum ModulesEnum: string
{
    case ABILITY = 'ability';

    case CUSTOMER = 'customer';

    case ROLE = 'role';

    case USER = 'user';
}
