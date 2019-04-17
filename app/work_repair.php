

<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Work_repair extends Model
{
    public $timestamps = false;
    public $table = 'work_repair';
    protected $primaryKey = 'work_repair_id';

    protected $fillable=[
    	'work_repair_id',
        'repair_status',
        'camera_id'
  
    ];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function camera(){
    	return $this->belongsTo('App\Camera','camera_id');
    }

}
