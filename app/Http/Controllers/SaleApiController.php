<?php

namespace App\Http\Controllers;

use App\Services\PaymentIntegration\MercadoLivre\Contracts\CreatePaymentServiceContract;
use App\Services\PaymentIntegration\MercadoLivre\Request\Contracts\MercadoLivreGetPaymentMethodsServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleApiController extends Controller
{
    public function __construct(
        protected CreatePaymentServiceContract $createPaymentService
    )
    {}

    public function sale(Request $request) : JsonResponse
    {
        $this->createPaymentService->pay($request->all());
        return response()->json([], 201);
    }
}
