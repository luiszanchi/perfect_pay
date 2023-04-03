<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Contracts;

interface CreatePaymentServiceContract
{
    public function pay(array $content);
}
