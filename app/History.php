<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;
    public $table = 'history';
    protected $primaryKey = 'history_id';

    protected $fillable=[
    	'history_id',
    	'camera_id',
    	'id',
    	'history_date'
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function camera(){
    	return $this->belongsTo('App\Camera','camera_id');
    }

}
