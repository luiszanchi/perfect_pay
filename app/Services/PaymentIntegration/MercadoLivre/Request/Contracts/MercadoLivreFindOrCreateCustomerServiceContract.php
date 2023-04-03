<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request\Contracts;

interface MercadoLivreFindOrCreateCustomerServiceContract
{
    public function getOrCreate (array $content);
}
