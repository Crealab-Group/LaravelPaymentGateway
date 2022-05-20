<?php

namespace Crealab\PaymentGateway\Contracts;

use Crealab\PaymentGateway\Models\PaymentModel;

interface PaymentInterface{
    public function beforeProcess(PaymentModel $payment);
    public function afterProcess(PaymentModel $payment);
    public function via();
}
