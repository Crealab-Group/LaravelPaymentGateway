<?php

namespace Crealab\PaymentGateway\Contracts;

use Crealab\PaymentGateways\Models\GatewayPayment;

interface PaymentInterface{
    public function beforeProcess(GatewayPayment $transaction);
    public function afterProcess(GatewayPayment $transaction);
    public function via();
}
