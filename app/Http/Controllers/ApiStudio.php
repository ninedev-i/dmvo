<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studio;

class Direction {
   public $name;
   public $studios;
}

class ApiStudio extends Controller {

   // Направления со студиями
   public function get_studios_by_directions() {
      $directions_array = ApiStudio::get_all_directions();

      $collection = collect();
      foreach($directions_array as $item) {
         $studio_list = ApiStudio::get_studio_list($item);
         $direction = new Direction();
         $direction->name = $item;
         $direction->studios = $studio_list;

         $collection->push($direction);
      };

      return $collection;
   }

   // Список всех направлений
   public function get_all_directions() {
      $directions_array = Studio::where('show_or_not', '=', '0')
         ->get(['direction'])
         ->pluck('direction')
         ->unique()->values();
      $directions_array = $directions_array->filter(function($value, $key) {
         return !strpos($value, ' ');
      })->values();

      return $directions_array;
   }

   // Список студий по направлению
   public function get_studio_list($direction) {
      $list = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'like', '%'.$direction.'%')
         ->orderBy('studio_name', 'asc')
         ->get(['shortname', 'studio_name', 'age_min', 'age_max', 'price', 'direction']);

      return $list;
   }
}
