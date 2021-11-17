<?php

namespace Crealab\PaymentGateway\Contracts;

use Crealab\PaymentGateway\Models\GatewayPayment;

interface PaymentInterface{
    public function beforeProcess(GatewayPayment $transaction);
    public function afterProcess(GatewayPayment $transaction);
    public function via();
}
