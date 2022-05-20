<?php

namespace Crealab\PaymentGateway\Contracts;

use Crealab\PaymentGateway\Models\PaymentModel;

interface PaymentInterface{
    /**
     * Method called before call external service
     * 
     * @param \Crealab\PaymentGateway\Models\PaymentModel $payment
     * 
     * @return void
     */
    public function beforeProcess(PaymentModel $payment);

    /**
     * Method called after call external service
     * 
     * @param \Crealab\PaymentGateway\Models\PaymentModel $payment
     * 
     * @return void
     */
    public function afterProcess(PaymentModel $payment);

    /**
     * Method that should return Gateway class
     * 
     * @param \Crealab\PaymentGateway\Models\PaymentModel $payment
     * 
     * @return string
     */
    public function via();
}
