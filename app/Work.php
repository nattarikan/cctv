<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public $timestamps = false;
    public $table = 'work';
    protected $primaryKey = 'work_id';

    protected $fillable=[
    	'work_id',
    	'work_date',
    	'camera_id',

        'history_des',
  
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function camera(){
    	return $this->belongsTo('App\Camera','camera_id');
    }

}
