<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $table = 'details';
    protected $fillable = array('reveal_id','pathological_case', 'diagnosis', 'pharmaceutical');
    public $timestamps = true;


    public function reveals()
	{
		return $this->belongsTo('App\Models\Reveal', 'reveal_id');
    }

    public function attachments()
	  {
		return $this->morphMany('App\Models\Attachment','ref');
    }
}
