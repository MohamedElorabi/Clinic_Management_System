<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = array('id','status', 'patient_id', 'reservation_time', 'fees');
    public $timestamps = true;



    public function patient()
	  {
		return $this->belongsTo('App\Models\Patient');
    }

    public function reveal()
    {
      return $this->belongsTo('App\Models\Reveal');
    }
}
