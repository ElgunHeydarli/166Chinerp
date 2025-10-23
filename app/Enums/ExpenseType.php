<?php

namespace App\Enums;

enum ExpenseType: string
{
    case ONETIME = 'one-time';
    case RECURRING = 'recurring';

    public function label(): string
    {
        return match ($this) {
            self::ONETIME => 'Birdəfəlik',
            self::RECURRING => 'Təkrarlanan',
        };
    }
}
