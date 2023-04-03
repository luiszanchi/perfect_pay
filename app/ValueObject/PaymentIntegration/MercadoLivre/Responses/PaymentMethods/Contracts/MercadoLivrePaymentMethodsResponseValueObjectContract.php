<?php

namespace App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\Contracts;

use Illuminate\Support\Collection;

interface MercadoLivrePaymentMethodsResponseValueObjectContract
{
    public function get(): Collection;
}
