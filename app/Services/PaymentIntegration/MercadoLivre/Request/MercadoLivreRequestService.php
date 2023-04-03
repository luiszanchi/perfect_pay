<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request;

use GuzzleHttp\Client;

abstract class MercadoLivreRequestService
{
    protected Client $client;
    protected string $baseUrl;
    protected string $publicKey;
    protected string $accessToken;

    public function __construct()
    {
        $this->baseUrl = config('ml.base_url');
        $this->publicKey = config('ml.public_key');
        $this->accessToken = config('ml.access_token');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->accessToken
            ]
        ]);
    }

}
