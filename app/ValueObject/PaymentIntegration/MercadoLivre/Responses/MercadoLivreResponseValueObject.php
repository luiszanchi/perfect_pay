<?php

namespace App\ValueObject\PaymentIntegration\MercadoLivre\Responses;

use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

abstract class MercadoLivreResponseValueObject
{
    public function __construct(
        protected ResponseInterface $response
    )
    {}

    protected function getContentFromResponse(): array
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

    protected function getCollectionFromContent(): Collection
    {
        return collect($this->getContentFromResponse());
    }

}
