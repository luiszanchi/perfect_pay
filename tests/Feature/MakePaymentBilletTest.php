<?php

namespace Tests\Feature;

use Faker\Factory;
use Faker\Generator;
use Tests\TestCase;

class MakePaymentBilletTest extends TestCase
{
    protected ?Generator $faker;

    public function __construct()
    {
        parent::__construct("test_billet");
        $this->faker = Factory::create();
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Person($this->faker));
    }

    /**
     * A basic feature test example.
     */
    public function test_billet(): void
    {
        $response = $this->post('/api/sale', [
            'cpf' => $this->faker->cpf(false),
            'email' => $this->faker->email(),
            'lastName' => $this->faker->lastName(),
            'name' => $this->faker->firstName(),
            'paymentType' => "billet",
            'value' => $this->faker->numberBetween(100, 9999999) / 100,
        ]);

        $response->assertStatus(201);
    }
}
