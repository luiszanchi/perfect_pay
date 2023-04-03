<?php

namespace App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\Contracts;

interface MercadoLivrePaymentMethodsResponseItemValueObjectContract
{
    public function isActive(): bool;
}
