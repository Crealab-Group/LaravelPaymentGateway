<?php

namespace Crealab\PaymentGateway\Contracts;

use Crealab\PaymentGateway\Payment;
use Crealab\PaymentGateway\Models\PaymentModel;

interface PaymentGatewayInterface{

    /**
     * Process a payment on the selected Gateway
     * 
     * @param \Crealab\PaymentGateway\Payment $payment
     * 
     * @return void
     */
    public function charge(Payment $payment);

    /**
     * Find by the unique identifier of the gateway. If the payment is not resolved it gets resolved before it is returned.
     * 
     * @param string $uid
     * 
     * @return \Crealab\PaymentGateway\Models\PaymentModel
     */
    public function findPayment():PaymentModel;


    /**
     * It process a refund for a given amount
     * 
     * @param mixed $payment
     * @param int $amount
     * 
     * @return mixed
     */
    public function refund($payment, int $amount);
}
