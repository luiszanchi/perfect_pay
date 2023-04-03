<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request\Contracts;

interface MercadoLivreCreateCustomerServiceContract
{
    public function get(array $content): array;
}
