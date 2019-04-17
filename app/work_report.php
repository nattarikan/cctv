<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Work_report extends Model
{
    public $timestamps = false;
    public $table = 'work_report';
    protected $primaryKey = 'work_report_id';

    protected $fillable=[
    	'work_report_id',
        'report_status',
        'camera_id'
  
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function camera(){
    	return $this->belongsTo('App\Camera','camera_id');
    }

}
