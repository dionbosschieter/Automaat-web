<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trunk extends Model {

    protected $table = 'trunk';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function bak()
    {
        return $this->belongsTo('App\Bak');
    }

    public function scopeOfBak($query, $bakId)
    {
        return $query->whereBakId($bakId);
    }

}