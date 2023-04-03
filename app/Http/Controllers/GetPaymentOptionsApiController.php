<?php

namespace App\Http\Controllers;

use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreGetPaymentMethodsServiceContract;
use Illuminate\Http\JsonResponse;

class GetPaymentOptionsApiController extends Controller
{
    public function __construct(
        protected MercadoLivreGetPaymentMethodsServiceContract $mercadoLivreGetPaymentMethodsService
    )
    {}

    public function get() : JsonResponse
    {
        return response()->json([
            'content' => $this->mercadoLivreGetPaymentMethodsService->get()
        ]);
    }
}
