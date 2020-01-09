<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attachment;
use App\Studio;
use App\Event;

class Tag {
   public $name;
   public $url;
}

class Events extends Controller {
   // Список ближайших мероприятий
   public function get_index() {
      $output['carousel'] = Events::get_carousel();
      $output['events'] = Events::get_closest_events(5);
      $output['exhibitions'] = Events::get_closest_exhibitions();
      $output['news'] = Events::get_news(0);

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

   // Список ближайших мероприятий для страницы Мероприятия
   public function get_all_closest_events() {
      $output['closestEvents'] = Event::where('date_to', '>=', date('Y-m-d'))
         ->where('show_or_not', '0')
         ->where('tags', 'NOT LIKE', '%exhibition%')
         ->orderBy('date_from', 'asc')
         ->get(['id', 'title', 'date_from', 'date_to', 'what_time']);

      $output['exhibitions'] = Event::where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'LIKE', '%exhibition%')
         ->orderBy('date_from', 'asc')
         ->take(4)
         ->get(['id', 'title', 'date_from', 'date_to', 'what_time']);

      return $output;
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

      // добавим теги
      if ($event->tags) {
         $in_studio_array = [];
         $studio = Studio::pluck('shortname', 'studio_name');
         foreach ($studio as $studioname) {
            array_push($in_studio_array, $studioname);
         }

         $tags_array = explode(' ', $event->tags);
         $event['tags'] = collect();

         foreach ($tags_array as $this_tag) {
            $tag = new Tag();
            if ($this_tag == 'psychological') {
               $tag->name = 'Психологическая служба';
               $tag->url = '/psychological';
            } elseif ($this_tag == 'online') {
               $tag->name = 'Волонтерский центр';
               $tag->url = '/volunteer';
            } elseif ($this_tag == 'transforce') {
               $tag->name = 'Транс-Форс';
               $tag->url = '/transforce';
            } elseif ($this_tag == 'familyclub') {
               $tag->name = 'Семейный клуб «ДМВО»';
               $tag->url = '/family';
            } elseif (in_array($this_tag, $in_studio_array)) {
               $current_studio = Studio::where('shortname', $this_tag)->first();
               $tag->name = $current_studio->studio_name;
               $tag->url = '/studio/'.$this_tag;
            } else {
               continue;
            }
            $event['tags']->push($tag);
         }
      }

      // добавим вложения
      $event['attachments'] = Attachment::where('event_id', '=', $id)
         ->get(['id', 'event_id', 'exists', 'is_button', 'path', 'title', 'type']);

      return $event;
   }
}
