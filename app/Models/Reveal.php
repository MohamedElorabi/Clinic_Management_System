<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reveal extends Model
{

    protected $table = 'reveals';
    protected $fillable = array('status', 'patient_id', 'detection_date', 'fees', 'fees_other' , 'is_finished', 'reveal_num');
    public $timestamps = true;


    public function patient()
	  {
		return $this->belongsTo('App\Models\Patient');
    }

    public function details()
	  {
		return $this->hasOne('App\Models\Details');
    }

    
    public function attachments()
	  {
		return $this->morphMany('App\Models\Attachment','ref')->where('ref_type','App\Models\Reveal');
    }


}
