<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Work_complete extends Model
{
    public $timestamps = false;
    public $table = 'work_complete';
    protected $primaryKey = 'work_complete_id';

    protected $fillable=[
    	'work_complete_id',
        'complete_status',
        'camera_id'
  
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function camera(){
    	return $this->belongsTo('App\Camera','camera_id');
    }

}
