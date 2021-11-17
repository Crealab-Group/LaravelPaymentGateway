<?php

namespace Crealab\PaymentGateway\Models;

use Illuminate\Database\Eloquent\Model;
use Crealab\PaymentGateway\Models\PaymentModel;

class GatewayPayment extends Model {
    protected $with =['payment'];

    public function isPending(){
        return ($this->payment->payment_status_id == 1);
    }

    public function isAccepted(){
        return ($this->payment->payment_status_id == 2);
    }

    public function isRejected(){
        return ($this->payment->payment_status_id == 3);
    }

    public function payment(){
        return $this->belongsTo(PaymentModel::class , 'payment_id', 'id');
    }
}
