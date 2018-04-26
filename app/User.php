<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
   use Notifiable;

   protected $fillable = [ 'username', 'bio', 'name', 'role', 'info', 'email', 'password', 'show_or_not',];

   protected $hidden = [ 'password', 'remember_token', ];

   public function studio() {
      return $this->hasMany('App\Studio', 'teacher', 'id');
   }
}
