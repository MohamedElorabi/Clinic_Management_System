<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model 
{

    protected $table = 'attachments';
    public $timestamps = false;
    protected $fillable = array('ref_id	', 'ref_type', 'value');

    public function ref()
    {
        $this->morphTo();
    }
}