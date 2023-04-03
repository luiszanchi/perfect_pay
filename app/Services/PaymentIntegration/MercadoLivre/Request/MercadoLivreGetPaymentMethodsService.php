<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request;

use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreGetPaymentMethodsServiceContract;
use App\Support\Requests\RequestsTypes;
use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\Contracts\MercadoLivrePaymentMethodsResponseValueObjectContract;

class MercadoLivreGetPaymentMethodsService extends MercadoLivreRequestService implements MercadoLivreGetPaymentMethodsServiceContract
{
    public function get(): array
    {
        return $this->generateResponse()->get()->toArray();
    }

    /**
     * @return MercadoLivrePaymentMethodsResponseValueObjectContract
     */
    protected function generateResponse()
    {
        return app(MercadoLivrePaymentMethodsResponseValueObjectContract::class, [
            'response' => $this->client->request(RequestsTypes::GET, 'payment_methods')
        ]);
    }
}
