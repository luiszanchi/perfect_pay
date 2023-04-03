<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request;

use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreFindCustomerByEmailServiceContract;
use App\Support\Requests\RequestsTypes;
use Illuminate\Support\Arr;

class MercadoLivreFindCustomerByEmailService extends MercadoLivreRequestService implements MercadoLivreFindCustomerByEmailServiceContract
{
    public function get(string $email): ?array
    {
        return $this->generateResponse($email);
    }

    /**
     * @return array
     */
    protected function generateResponse(string $email)
    {
        $response = $this->client->request(RequestsTypes::GET, 'v1/customers/search', [
            'query' => [
                'email' => $email
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken
            ]
        ]);

        $results = Arr::get(
            json_decode($response->getBody()->getContents(), true),
            'results',
            []
        );

        return count($results) > 0 ? $results[0] : null;
    }
}
