<?php

namespace App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods;

use App\Support\PaymentMethodStatus\PaymentMethodStatus;
use App\ValueObject\PaymentIntegration\MercadoLivre\Responses\PaymentMethods\Contracts\MercadoLivrePaymentMethodsResponseItemValueObjectContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class MercadoLivrePaymentMethodsResponseItemValueObject implements Arrayable, MercadoLivrePaymentMethodsResponseItemValueObjectContract
{
    protected string $id;
    protected string $name;
    protected string $thumbnail;
    protected string $status;
    protected float $minAllowedAmount;
    protected float $maxAllowedAmount;

    public function __construct(
        protected array $item
    )
    {
        $this->id = Arr::get($this->item, 'id');
        $this->name = Arr::get($this->item, 'name');
        $this->thumbnail = Arr::get($this->item, 'thumbnail');
        $this->status = Arr::get($this->item, 'status');
        $this->minAllowedAmount = Arr::get($this->item, 'min_allowed_amount');
        $this->maxAllowedAmount = Arr::get($this->item, 'max_allowed_amount');
    }

    public function isActive(): bool
    {
        return $this->status == PaymentMethodStatus::ACTIVE;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'thumbnail' => $this->thumbnail,
            'status' => $this->status,
            'minAllowedAmount' => $this->minAllowedAmount,
            'maxAllowedAmount' => $this->maxAllowedAmount,
        ];
    }

}
