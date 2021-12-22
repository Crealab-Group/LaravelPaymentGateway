<?php

namespace Crealab\PaymentGateway;

use Crealab\PaymentGateway\Contracts\PaymentInterface;
use Crealab\PaymentGateway\Models\PaymentModel;
use Crealab\PaymentGateway\Models\GatewayPayment;

abstract class Payment implements PaymentInterface{

    public int $amount;
    public int $discount;
    public int $feesNumber;
    public int $feeAmount;
    public $detail;

    public function __construct(int $amount, int $feesNumber = 1, int $discount = 0, int $feeAmount = 0, $detail = null)
    {
        $this->amount = $amount;
        $this->feesNumber = $feesNumber;
        $this->discount = $discount;
        $this->detail = $detail;
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
    abstract public function beforeProcess(GatewayPayment $payment);

    /**
     * Función para ser sobreescrita en la creación de un pago
     *
     *  @return mixed
     */
    abstract public function afterProcess(GatewayPayment $payment);

    /**
     * Función para ser sobreescrita en la creación de un pago
     *
     * @return PaymentGateway
     */
    abstract public function via();

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
