<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request\Contracts;

use Psr\Http\Message\ResponseInterface;

interface MercadoLivreRequestServiceContract
{
    public function get(): array;
}
