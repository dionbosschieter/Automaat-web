<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bak extends Model {

    protected $table = 'bak';
    protected $guarded = ['id'];

    public function trunks()
    {
        return $this->hasMany('App\Trunk');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function hasNotEnoughMoneyFor($amountToPay)
    {
        foreach($this->trunks()->get() as $trunk) {
            if($trunk->bill_type > $amountToPay) continue;
            if($amountToPay == 0) break;

            for($i=0;$i<$trunk->available;$i++) {
                if($amountToPay == 0) break;
                $amountToPay -= $trunk->bill_type;
            }
        }

        return $amountToPay > 0;
    }

    public function getAmountAttribute()
    {
        $amount = 0;
        foreach($this->trunks as $trunk) {
            $amount += $trunk->available * $trunk->bill_type;
        }

        return $amount;
    }

}
