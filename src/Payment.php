<?php

namespace Crealab\PaymentGateway;

use Crealab\PaymentGateways\Contracts\PaymentInterface;
use Crealab\PaymentGateways\Models\PaymentModel;
use Crealab\PaymentGateways\Models\GatewayPayment;

class Payment implements PaymentInterface{

    public int $amount;
    public int $discount;
    public int $feesNumber;
    public int $feeAmount;

    public function __construct(int $amount, int $feesNumber = 1, int $discount = 0, int $feeAmount = 0)
    {
        $this->amount = $amount;
        $this->feesNumber = $feesNumber;
        $this->discount = $discount;
        $this->feeAmount = $this->calcFeeAmount($feeAmount);
    }

    private function calcFeeAmount(int $feeAmount ){
        if($feeAmount == 0 && $this->feesNumber == 1){
            return $this->amount;
        }
        if($feeAmount == 0 && $this->feesNumber != 1){
            return  round( ( $this->amount / $this->feesNumber ), 0, PHP_ROUND_HALF_UP);
        }
        return $feeAmount;
    }

    /**
     * Función para ser sobreescrita en la creación de un pago
     *
     * @return mixed
     */
    public function beforeProcess(GatewayPayment $payment){
        return;
    }

    /**
     * Función para ser sobreescrita en la creación de un pago
     *
     *  @return mixed
     */
    public function afterProcess(GatewayPayment $payment){
        return;
    }
    /**
     * Función para ser sobreescrita en la creación de un pago
     *
     * @return mixed null|PaymentGateway
     */
    public function via(){
        return null;
    }

    public function process(){
        if(is_null($this->via())){
            return;
        }
        $className = $this->via();
        $gateway =  new $className();
        return $gateway->charge($this);
    }

    public function getPersistentData(){
        return PaymentModel::create($this->toArray());
    }

    public function toArray(){
        return [
            'amount'        => $this->amount,
            'discount'      => $this->discount,
            'fees_number'    => $this->feesNumber,
            'fee_amount'    => $this->feeAmount,
            'payment_class' => get_class($this)
        ];
    }
}
