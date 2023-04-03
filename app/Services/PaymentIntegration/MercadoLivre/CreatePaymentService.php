<?php

namespace App\Services\PaymentIntegration\MercadoLivre;

use App\Services\PaymentIntegration\MercadoLivre\Contracts\CreatePaymentServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreFindOrCreateCustomerServiceContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use MercadoPago\Payment;
use MercadoPago\SDK;

class CreatePaymentService implements CreatePaymentServiceContract
{
    protected Payment $payment;

    protected int $time;

    protected array $content;
    protected string $baseUrl;
    protected string $publicKey;
    protected string $accessToken;

    public function __construct(
        protected MercadoLivreFindOrCreateCustomerServiceContract $mercadoLivreFindOrCreateCustomerService
    )
    {
        $this->time = time();

        $this->baseUrl = config('ml.base_url');
        $this->publicKey = config('ml.public_key');
        $this->accessToken = config('ml.access_token');
    }

    protected function getCustomerIdentification(): array
    {
        return [
            "type" => "CPF",
            "number" => $this->getItemFromContent('cpf', '')
        ];
    }

    protected function getCustomer(): array
    {
        return $this->mercadoLivreFindOrCreateCustomerService
            ->getOrCreate($this->content);
    }

    public function pay(array $content)
    {
        SDK::setAccessToken(env('ML_ACCESS_TOKEN'));
        SDK::setPublicKey(env('ML_PUBLIC_KEY'));

        $this->payment = new Payment();

        $this->content = $content;

        $responseClient = $this->getCustomer();

        $this->payment->payer = [
            "entity_type" => "individual",
            "type" => "customer",
            "identification" => $this->getCustomerIdentification()
        ];

        $this->payment->description = 'Pagamento Teste ' . $responseClient['first_name'] . ' ' . $responseClient['last_name'] . ' - ' . $this->time;
        $this->payment->external_reference = md5($this->time);
        $this->payment->transaction_amount = $this->getItemFromContent('value');

        $this->payment->payment_method_id = $this->getItemFromContent('paymentType', '');

        $this->creditCard();

        $responsePayment = App::runningUnitTests() || $this->payment->save();

        Log::info('payment-test', [
            'response_customer' => $responseClient,
            'payment' => $this->payment->toArray(),
            'response_payment' => $responsePayment
        ]);
    }

    protected function getItemFromContent(string $key, string $default = '')
    {
        return Arr::get($this->content, $key, $default);
    }

    protected function isCreditCardOperation(): bool
    {
        return $this->getItemFromContent('paymentType', '') == 'credit_card';
    }

    protected function isBilletOperation(): bool
    {
        return $this->getItemFromContent('paymentType', '') == 'billet';
    }

    protected function creditCard()
    {
        if ($this->isBilletOperation()) {
            return;
        }

        $this->payment->token = $this->getTokenFromCreditCard();

        $this->payment->installments = $this->getItemFromContent('installments');
    }

    protected function getTokenFromCreditCard(): string
    {
        if (App::runningUnitTests()) {
            return "123";
        }

        $payload = [
            "json_data" => [
                "card_number" => $this->getItemFromContent('credit_card'),
                "security_code" => (string) $this->getItemFromContent('credit_card_security_code'),
                "expiration_month" => str_pad($this->getItemFromContent('credit_card_month_expiration'), 2, '0', STR_PAD_LEFT),
                "expiration_year" => str_pad($this->getItemFromContent('credit_card_year_expiration'), 4, '0', STR_PAD_LEFT),
                "cardholder" => [
                    "name" => 'APRO',
                    "identification" => $this->getCustomerIdentification()
                ]
            ]
        ];

        return Arr::get(
            SDK::post('/v1/card_tokens', $payload),
            'body.id'
        );
    }
}
