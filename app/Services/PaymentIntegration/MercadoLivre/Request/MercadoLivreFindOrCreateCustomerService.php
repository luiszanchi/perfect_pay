<?php

namespace App\Services\PaymentIntegration\MercadoLivre\Request;

use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreCreateCustomerServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreFindCustomerByEmailServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreFindOrCreateCustomerServiceContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

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
        if (App::runningUnitTests()) {
            return [
                "id" => "1344597017-PJUWbNcDhW6b1H",
                "email" => Arr::get($content, 'email'),
                "first_name" => Arr::get($content, 'name'),
                "last_name" => Arr::get($content, 'lastName'),
                "phone" => [
                  "area_code" => null,
                  "number" => null,
                ],
                "identification" => [
                  "type" => "CPF",
                  "number" => Arr::get($content, 'cpf'),
                ],
                "address" => [
                  "id" => null,
                  "zip_code" => null,
                  "street_name" => null,
                  "street_number" => null,
                ],
                "date_registered" => null,
                "description" => "Cliente criado em 1680536588",
                "date_created" => "2023-04-03T11:43:11.028-04:00",
                "date_last_updated" => "2023-04-03T11:43:11.028-04:00",
                "default_card" => null,
                "default_address" => null,
                "cards" => [],
                "addresses" => [],
                "live_mode" => false,
                "user_id" => 1344597017,
                "merchant_id" => 343999868,
                "client_id" => 4419922878215203,
                "status" => "active",
              ];
        }

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
