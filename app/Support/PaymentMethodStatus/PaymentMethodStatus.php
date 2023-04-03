<?php

namespace App\Support\PaymentMethodStatus;

class PaymentMethodStatus
{
    const ACTIVE = 'active';
    const TESTING = 'testing';

    public static function all(): array
    {
        return [
            self::ACTIVE,
            self::TESTING,
        ];
    }
}
