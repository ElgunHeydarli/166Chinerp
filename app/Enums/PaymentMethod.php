<?php

namespace App\Enums;

enum PaymentMethod : string
{
    case CASH = "cash";
    case BANK = "bank";

    public function label() : string{
        return match($this){
            self::CASH=>'Nağd',
            self::BANK=>'Bank',
        };
    }
}