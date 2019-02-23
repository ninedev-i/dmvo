<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studio;

class ApiStudio extends Controller {

   // Список ближайших мероприятий
   // Страница мероприятия
   public function get_studio_page() {
      $studio = Studio::where('show_or_not', '=', '0')
         ->orderBy('studio_name', 'asc')
         ->get(['shortname', 'studio_name', 'age_min', 'age_max', 'price', 'direction']);

      return $studio;
   }
}
