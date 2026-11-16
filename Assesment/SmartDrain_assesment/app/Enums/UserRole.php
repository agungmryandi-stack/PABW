<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Warga = 'warga';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Warga => 'Warga',
        };
    }
}