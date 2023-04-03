<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request;

use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreCreateCustomerServiceContract;
use App\Support\Requests\RequestsTypes;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class MercadoLivreCreateCustomerService extends MercadoLivreRequestService implements MercadoLivreCreateCustomerServiceContract
{
    public function get(array $content): array
    {
        return json_decode($this->generateResponse($content)->getBody()->getContents(), true);
    }

    /**
     * @return ResponseInterface
     */
    protected function generateResponse(array $content)
    {
        return $this->client->request(RequestsTypes::POST, 'v1/customers', [
            'json' => $content,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken
            ]
        ]);
    }
}
