<?php

namespace App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods;

use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\MercadoLivreResponseValueObject;
use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\Contracts\MercadoLivrePaymentMethodsResponseItemValueObjectContract;
use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\Contracts\MercadoLivrePaymentMethodsResponseValueObjectContract;
use Illuminate\Support\Collection;

class MercadoLivrePaymentMethodsResponseValueObject extends MercadoLivreResponseValueObject implements MercadoLivrePaymentMethodsResponseValueObjectContract
{
    public function get(): Collection
    {
        return $this->getCollectionFromContent()
            ->map(fn($item) => app(MercadoLivrePaymentMethodsResponseItemValueObjectContract::class, ['item' => $item]));
    }
}
