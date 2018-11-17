<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudioRequests extends Model {

   protected $table = 'requests';

   public function getStudio() {
      return $this->hasOne('App\Studio', 'shortname', 'studio');
   }

   function calculateAge($birthday) {
      if ($birthday === '0000-00-00') {
         return '-';
      }

      $birthday_timestamp = strtotime($birthday);

      $age = date('Y') - date('Y', $birthday_timestamp);
      if (date('md', $birthday_timestamp) > date('md')) {
         $age--;
      }

      return $age;
   }
}
