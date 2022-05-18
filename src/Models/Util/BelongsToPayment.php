<?php

namespace Crealab\PaymentGateway\Models\Util;

use Crealab\PaymentGateway\Models\PaymentModel;

trait BelongsToPayment{
    public function payment(){
        return $this->morphOne(PaymentModel::class , 'implementation');
    }
}