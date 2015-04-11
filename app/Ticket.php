<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    protected $table = 'ticket';
    protected $guarded = ['id'];

	public function bak()
    {
        $this->belongsTo('App\Bak');
    }

}
