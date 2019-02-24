<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	public $timestamps = false;
    public $table = 'news';
    protected $primaryKey = 'news_id';

}
