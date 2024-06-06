<?php

namespace App\Services;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PayPalService
{
    private $client;

    public function __construct()
    {
        $environment = new SandboxEnvironment(config('paypal.client_id'), config('paypal.secret'));
        $this->client = new PayPalHttpClient($environment);
    }

    public function client()
    {
        return $this->client;
    }
}
