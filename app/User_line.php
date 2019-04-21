<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User_line extends Authenticatable
{
   use Notifiable;
   
   // ...
   
   /**
    * @return string LINE Notify OAuth2 token 
    */
   protected function routeNotificationForLine()
   {
       return 'hogehogehoge';
   }
}