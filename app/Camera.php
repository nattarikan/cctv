<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    public $timestamps = false;
    public $table = 'camera';
    protected $primaryKey = 'camera_id';

    public function history(){
    	return $this->hasMany('App\History','history_id');
    }

    protected $fillable=[
    	'camera_name',
        'camera_server',
        'camera_ip',
        'camera_brand'
    ];

}
