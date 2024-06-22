<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function payWithPayPal($orderId)
    {
        $pedido = Pedido::findOrFail($orderId);
        
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($pedido->total);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Compra en La Blanca');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.status'))
            ->setCancelUrl(route('paypal.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return redirect()->route('cart')->with('error', 'Error al conectar con PayPal');
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectUrl = $link->getHref();
                break;
            }
        }

        return redirect()->away($redirectUrl);
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->paymentId;
        $payerId = $request->PayerID;

        if (empty($paymentId) || empty($payerId)) {
            return redirect()->route('home')->with('error', 'Pago cancelado');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);

            if ($result->getState() == 'approved') {
                // Actualizar el pedido a pagado
                return redirect()->route('home')->with('success', 'Pago realizado exitosamente');
            }
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return redirect()->route('home')->with('error', 'Error al procesar el pago');
        }

        return redirect()->route('home')->with('error', 'Pago no realizado');
    }
}
