<?php

namespace App\Providers;

use App\Services\PaymentIntegration\MercadoLivre\Contracts\CreatePaymentServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\CreatePaymentService;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreGetPaymentMethodsServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\MercadoLivreCreateCustomerService;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreCreateCustomerServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreFindCustomerByEmailServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreFindOrCreateCustomerServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\MercadoLivreFindCustomerByEmailService;
use App\Services\PaymentIntegration\MercadoLivre\Request\MercadoLivreFindOrCreateCustomerService;
use App\Services\PaymentIntegration\MercadoLivre\Request\MercadoLivreGetPaymentMethodsService;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MercadoLivreGetPaymentMethodsServiceContract::class, MercadoLivreGetPaymentMethodsService::class);

        $this->app->bind(CreatePaymentServiceContract::class, CreatePaymentService::class);
        $this->app->bind(MercadoLivreCreateCustomerServiceContract::class, MercadoLivreCreateCustomerService::class);
        $this->app->bind(MercadoLivreFindCustomerByEmailServiceContract::class, MercadoLivreFindCustomerByEmailService::class);

        $this->app->bind(MercadoLivreFindOrCreateCustomerServiceContract::class, MercadoLivreFindOrCreateCustomerService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
