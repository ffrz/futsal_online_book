<?php

namespace App\Enums;

enum UserRoles: int
{
    case SUPER_ADMINISTRATOR = 1;
    case ADMINISTRATOR = 2;
    case POWER_USER = 3;
    case USER = 4;

    public function toString()
    {
        return match ($this) {
            static::SUPER_ADMINISTRATOR  => 'Super Administrator',
            static::ADMINISTRATOR  => 'Administrator',
            static::POWER_USER  => 'Power User',
            static::USER  => 'User',
        };
    }
}
