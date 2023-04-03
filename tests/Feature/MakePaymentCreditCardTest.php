<?php

namespace Tests\Feature;

use Faker\Factory;
use Faker\Generator;
use Tests\TestCase;

class MakePaymentCreditCardTest extends TestCase
{
    protected ?Generator $faker;

    public function __construct()
    {
        parent::__construct("test_credit_card");
        $this->faker = Factory::create();
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Person($this->faker));
    }

    /**
     * A basic feature test example.
     */
    public function test_credit_card(): void
    {
        $year = ((int) date('Y')) + 1;

        $response = $this->post('/api/sale', [
            'cpf' => $this->faker->cpf(false),
            'credit_card' => (string) $this->faker->creditCardNumber('Visa'),
            'credit_card_month_expiration' => $this->faker->numberBetween(1, 12),
            'credit_card_security_code' => $this->faker->numberBetween(100, 999),
            'credit_card_year_expiration' => $this->faker->numberBetween($year, $year + 10),
            'email' => $this->faker->email(),
            'installments' => $this->faker->numberBetween(1, 12),
            'lastName' => $this->faker->lastName(),
            'name' => $this->faker->firstName(),
            'paymentType' => "creadit_card",
            'value' => 80.5,
        ]);

        $response->assertStatus(201);
    }
}
