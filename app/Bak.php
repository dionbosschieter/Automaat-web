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

    public function getAmountAttribute()
    {
        $amount = 0;
        foreach($this->trunks as $trunk) {
            $amount += $trunk->available * $trunk->bill_type;
        }

        return $amount;
    }


}
