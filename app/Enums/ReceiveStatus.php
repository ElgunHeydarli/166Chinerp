<?php

namespace App\Enums;

enum ReceiveStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case NOT_PAID = 'not_paid';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Gözləmədə',
            self::PAID => 'Ödənilib',
            self::NOT_PAID => 'Ödənilməyib',
        };
    }

    public function class_name(): string
    {
        return match ($this) {
            self::PENDING => 'waiting',
            self::PAID => 'paid',
            self::NOT_PAID => 'notPaid',
        };
    }
}
