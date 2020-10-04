<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $table = 'patients';
    protected $fillable = array('id', 'patient_code', 'name', 'age', 'phone', 'address');
    public $timestamps = true;


    public function reveals()
	{
		return $this->hasMany('App\Models\Reveal');
  }
  
  public function reveal()
	{
		return $this->hasOne('App\Models\Reveal', 'patient_id')->orderBy('reveals.id', 'DESC');
  }

  public function reservations()
  {
    return $this->hasMany('App\Models\Reservation');
  }

  public function reservation()
	{
		return $this->hasOne('App\Models\Reservation', 'patient_id')->orderBy('reservations.id', 'DESC');
    }


 
}
