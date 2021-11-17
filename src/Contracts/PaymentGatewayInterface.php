<?php

namespace Crealab\PaymentGateway\Contracts;

use Crealab\PaymentGateway\Payment;

interface PaymentGatewayInterface{
    public function charge(Payment $payment);
    public function showPayment();
    public function refund($payment, int $amount);
}
