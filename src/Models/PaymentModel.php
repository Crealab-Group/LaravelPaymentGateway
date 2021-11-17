<?php

namespace Crealab\PaymentGateway\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model {
    protected $table = 'payment';
    protected $fillable = ['amount', 'discount', 'fees_number','fee_amount', 'payment_status_id', 'payment_class'];

    public function isPending(){
        return ($this->payment_status_id == 1);
    }

    public function isAccepted(){
        return ($this->payment_status_id == 2);
    }

    public function isRejected():bool{
        return ($this->payment_status_id == 3);
    }

    public function setStatus(string $state){
        $state = strtolower($state);
        $validStates = ['pending', 'accepted', 'rejected'];
        if(!in_array($state, $validStates)){
            throw new \Exception('Estado inválido');
        }
        switch($state){
            case 'pending':
                $this->payment_status_id = 1;
            break;
            case 'accepted':
                $this->payment_status_id = 2;
            break;
            case 'rejected':
                $this->payment_status_id = 3;
            break;
        }
        $this->save();
    }

    public function recreatePayment(){
        $className = $this->payment_class;
        return new $className($this->amount, $this->fees_number , $this->discount , $this->fee_amount );
    }
}
