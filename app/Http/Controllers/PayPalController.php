<?php

namespace App\Http\Controllers;

use App\Services\PayPalService;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    private $payPalService;

    public function __construct(PayPalService $payPalService)
    {
        $this->payPalService = $payPalService;
    }

    public function createOrder(Request $request)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'value' => '100.00',
                    'currency_code' => 'USD'
                ]
            ]],
            'application_context' => [
                'cancel_url' => route('paypal.cancel'),
                'return_url' => route('paypal.return'),
            ] 
        ];

        try {
            $response = $this->payPalService->client()->execute($request);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Unable to create PayPal order'], 500);
        }
    }

    public function captureOrder($orderId)
    {
        $request = new OrdersCaptureRequest($orderId);
        $request->prefer('return=representation');

        try {
            $response = $this->payPalService->client()->execute($request);
            return response()->json($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Unable to capture PayPal order'], 500);
        }
    }

    public function cancel()
    {
        return response()->json(['status' => 'Payment was cancelled']);
    }

    public function return()
    {
        return response()->json(['status' => 'Payment was successful']);
    }
}
