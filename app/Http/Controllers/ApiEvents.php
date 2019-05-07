<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class ApiEvents extends Controller {

   public function ping() {
      return 'Попингуй мне тут';
   }

   // Список ближайших мероприятий
   public function get_index() {
      $output['carousel'] = ApiEvents::get_carousel();
      $output['events'] = ApiEvents::get_closest_events(5);
      $output['exhibitions'] = ApiEvents::get_closest_exhibitions();
      $output['news'] = ApiEvents::get_news(0);

      return $output;
   }
   public function get_carousel() {
      $slider = Event::where('right_column', '=', '1')
         ->where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->orderBy('date_from', 'ASC')
         ->get();
      return $slider;
   }

   // Список ближайших мероприятий
   public function get_closest_events($quantity = 100) {
      $closestEvents = Event::where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'NOT LIKE', '%news%')
         ->where('tags', 'NOT LIKE', '%exhibition%')
         ->where('show_or_not', '0')
         ->orderBy('date_from', 'asc')
         ->take($quantity)
         ->get(['id', 'title', 'date_from', 'date_to', 'what_time']);

      return $closestEvents;
   }

   // Список ближайших конкурсов и выставок
   public function get_closest_exhibitions() {
      $exhibitions = Event::where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'LIKE', '%exhibition%')
         ->orderBy('date_from', 'asc')
         ->take(4)
         ->get(['id', 'title', 'date_from', 'date_to', 'what_time']);

      return $exhibitions;
   }

   // Список прошедших мероприятий по годам
   public function get_past_events($year) {
      $events = [];

      for ($month = 12; $month >= 1; $month--){
         $monthNames = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
         $monthEvents = Event::where('show_or_not', '=', '0')
            ->where('date_to', '<', date('Y-m-d'))
            ->whereYear('date_to', '=', $year)
            ->whereMonth('date_to', '=', $month)
            ->where('tags', 'NOT LIKE', '%news%')
            ->orderBy('date_to', 'desc')
            ->distinct()
            ->get(['id', 'title', 'date_from', 'date_to', 'what_time']);

            $ru_month = strftime("%B", mktime(0, 0, 0, $month, 12));
            $events[$monthNames[$month - 1]] = $monthEvents;
      }

      return json_encode($events);
   }

   // Список пост-релизов конкурсов и выставок
   public function get_news($offset, $tag = false) {
      $events = Event::where('post_reliz', '!=', '')
         ->where('show_or_not', '0');

      if ($tag) {
         $events = $events->where('tags', 'LIKE', '%'.$tag.'%');
      }

      $events = $events->orderBy('date_to', 'desc')
         ->skip($offset * 12)
         ->take(12)
         ->get(['id', 'title', 'date_from', 'date_to', 'what_time', 'post_reliz']);

      return $events;
   }

   // Страница мероприятия
   public function get_event($id) {
      $event = Event::where('id', $id)
         ->where('show_or_not', '=', '0')
         ->first();

      return $event;
   }
}
