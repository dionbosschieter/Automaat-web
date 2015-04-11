<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bak extends Model {

    protected $table = 'bak';
    protected $guarded = ['id'];

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

}
