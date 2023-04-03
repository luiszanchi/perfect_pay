<?php

namespace App\Providers;

use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\Contracts\MercadoLivrePaymentMethodsResponseItemValueObjectContract;
use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\Contracts\MercadoLivrePaymentMethodsResponseValueObjectContract;
use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\MercadoLivrePaymentMethodsResponseItemValueObject;
use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\MercadoLivrePaymentMethodsResponseValueObject;
use Illuminate\Support\ServiceProvider;

class ValueObjectProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MercadoLivrePaymentMethodsResponseValueObjectContract::class, MercadoLivrePaymentMethodsResponseValueObject::class);
        $this->app->bind(MercadoLivrePaymentMethodsResponseItemValueObjectContract::class, MercadoLivrePaymentMethodsResponseItemValueObject::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
