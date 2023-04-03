<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request\Contracts;

interface MercadoLivreFindCustomerByEmailServiceContract
{
    public function get(string $email): ?array;
}
