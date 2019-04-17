<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Work_detail extends Model
{
    public $timestamps = false;
    public $table = 'work_detail';
    protected $primaryKey = 'work_detail_id';

    protected $fillable=[
    	'work_detail_id',
        'work_id',
        'camera_id'
  
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function camera(){
    	return $this->belongsTo('App\Camera','camera_id');
    }

}
