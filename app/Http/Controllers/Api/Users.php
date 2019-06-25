<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Studio;
use App\User;

class Users extends Controller {
   // Данные о пользователе
   public function get_user_info($id) {
      $user = User::where('show_or_not', '!=', 'false')
                   ->where('id', '=', $id)
                   ->orderBy('name', 'asc')
                   ->get(['id', 'username', 'name', 'users.phone', 'position', 'email', 'reception_time', 'role', 'bio'])
                   ->first();

      $studios = Studio::where('show_or_not', '=', '0')
                       ->get(['shortname', 'studio_name', 'teacher']);

      $user['studios'] = collect();
      foreach($studios as $studio) {
         $teachers_array = explode(', ', $studio->teacher);
         if (in_array($user->id, $teachers_array)) {
            $user['studios']->push($studio);
         }
      }

      return $user;
   }
}