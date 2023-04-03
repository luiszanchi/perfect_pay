<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request;

use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreCreateCustomerServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreFindCustomerByEmailServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreFindOrCreateCustomerServiceContract;
use Illuminate\Support\Arr;

class MercadoLivreFindOrCreateCustomerService implements MercadoLivreFindOrCreateCustomerServiceContract
{
    protected array $content;

    public function __construct(
        protected MercadoLivreFindCustomerByEmailServiceContract $mercadoLivreFindCustomerByEmailService,
        protected MercadoLivreCreateCustomerServiceContract $mercadoLivreCreateCustomerService
    )
    {}

    public function getOrCreate (array $content)
    {
        $this->content = $content;

        $clientExistent = $this->mercadoLivreFindCustomerByEmailService
            ->get(
                $this->getItemFromContent('email', '')
            );

        if ($clientExistent) {
            return $clientExistent;
        }

        return $this->mercadoLivreCreateCustomerService
            ->get([
                "email" => $this->getItemFromContent('email', ''),
                "first_name"=> $this->getItemFromContent('name', ''),
                "last_name"=> $this->getItemFromContent('lastName', ''),
                "identification" => $this->getCustomerIdentification(),
                "description" => "Cliente criado em " . ((string) time()),
            ]);
    }

    protected function getItemFromContent(string $key, string $default = '')
    {
        return Arr::get($this->content, $key, $default);
    }

    protected function getCustomerIdentification(): array
    {
        return [
            "type" => "CPF",
            "number" => $this->getItemFromContent('cpf', '')
        ];
    }
}
