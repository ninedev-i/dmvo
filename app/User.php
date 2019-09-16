<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
   use HasApiTokens, Notifiable;

   protected $fillable = [ 'email', 'password' ];

   protected $hidden = [ 'password', /*'remember_token',*/ ];

   public function studio() {
      return $this->hasMany('App\Studio', 'teacher', 'id');
   }

   public function setPasswordAttribute($password) {
      $this->attributes['password'] = bcrypt($password);
   }
}
