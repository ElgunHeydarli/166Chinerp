<?php

namespace App\Enums;

enum OrderMixFull: string
{
    case MIX = 'mix';
    case FULL = 'full';
    case AUTOMOBILE = 'automobile';

    public function label(): string
    {
        return match ($this) {
            self::MIX => 'Mix',
            self::FULL => 'Full',
            self::AUTOMOBILE => 'Avtomobil',
        };
    }
}
