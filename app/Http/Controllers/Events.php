<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\View;
use App\Http\Requests;
use App\Attachment;
use App\Page;
use Request;
use App\Event;
use App\Studio;
use Auth;
use URL;
use DB;

class Events extends Controller {

// Ближайшие мероприятия
   public function renderEventsPage() {
      $title = 'Мероприятия дома молодежи Василеостровского района';

      $events = Event::where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'NOT LIKE', '%news%')
         ->where('tags', 'NOT LIKE', '%exhibition%')
         ->orderBy('date_from', 'asc')
         ->get();

      $exhibitions = Event::where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'LIKE', '%exhibition%')
         ->orderBy('date_from', 'asc')
         ->get();

      if (Auth::check() && in_array(Auth::user()->id, [1, 57, 63, 90])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/addevent">Добавить новое мероприятие</a></i>';
      } else {$adminlink = '';}

      return View::make('events')
         ->with('title', $title)
         ->with('currentDate', date('Y-m-d'))
         ->with('adminlink', $adminlink)
         ->with('events', $events)
         ->with('exhibitions', $exhibitions);
   }

   // Прошедшие мероприятия
   public function renderPastEventsPage() {
      $title = 'Архив мероприятий';
      $searchValue = '';

      $events = Event::where('show_or_not', '=', '0')
         ->where('date_from', '<', date('Y-m-d'))
         ->where('tags', 'NOT LIKE', '%news%')
         // ->groupBy(DB::raw( date_format(new DateTime(date_to), 'Y') ))
         ->orderBy('date_from', 'desc')
         ->distinct()
         ->get();

      if (Auth::check() && in_array(Auth::user()->id, [1, 57, 63, 90])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/addevent">Добавить новое мероприятие</a></i>';
      } else {$adminlink = '';}

      return View::make('eventspast')
         ->with('title', $title)
         ->with('adminlink', $adminlink)
         ->with('searchValue', $searchValue)
         ->with('events', $events);
   }

   // Мероприятия не ДМВО
   public function otherEvents() {
      $title = 'Городские и районные мероприятия';
      $events = Event::where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'LIKE', '%news%')
         ->orderBy('date_from', 'asc')
         ->get();

      $exhibitions = [];

      if (Auth::check() && in_array(Auth::user()->id, [1, 57, 63, 90])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/addevent">Добавить новое мероприятие</a></i>';
      } else {$adminlink = '';}

      return View::make('events')
         ->with('title', $title)
         ->with('currentDate', date('Y-m-d'))
         ->with('adminlink', $adminlink)
         ->with('events', $events)
         ->with('exhibitions', $exhibitions);
   }

   // Поиск по мероприятиям
   public function searchEventsPage($eventTitle) {
      $title = 'Поиск по мероприятиям';

      $events = Event::where('show_or_not', '=', '0')
         ->where('title', 'LIKE', '%'.$eventTitle.'%')
         ->orderBy('date_from', 'desc')
         ->distinct()
         ->get();

      $searchValue = $eventTitle;

      if (Auth::check() && in_array(Auth::user()->id, [1, 57, 63, 90])) {
      $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/addevent">Добавить новое мероприятие</a></i>';
      } else {$adminlink = '';}

      return View::make('eventspast')
         ->with('title', $title)
         ->with('adminlink', $adminlink)
         ->with('searchValue', $searchValue)
         ->with('events', $events);
   }

   // Отдельно взятое мероприятие
   public function renderCurrentEventPage($id) {

      if (Auth::check() && in_array(Auth::user()->id, [1, 57, 63, 90])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editevent/'.$id.'">Редактировать мероприятие</a> <a href="'.URL::to('/').'/admin/addevent" style="margin-left: 10px;">Добавить мероприятие</a></i>';
      } else {$adminlink = '';}

      $event = Event::where('id', $id)
         ->where('show_or_not', '=', '0')
         ->first();

      $tags = [];
      if ($event->tags) {
         $in_studio_array = [];
         $studio = DB::table('studio')->pluck('shortname', 'studio_name');
         foreach ($studio as $studioname) {
            array_push($in_studio_array, $studioname);
         }

         $tags_array = explode(' ', $event->tags);
         foreach ($tags_array as $this_tag) {
            if ($this_tag == 'psychological') {array_push($tags, "<li class='studios_news'><a href='".URL::to('/')."/psychological' class='smallbutton'>Психологическая служба</a></li>");}
            elseif ($this_tag == 'online') {array_push($tags, "<li class='studios_news'><a href='".URL::to('/')."/volunteer' class='smallbutton'>Волонтерский центр</a></li>");}
            elseif ($this_tag == 'familyclub') {array_push($tags, "<li class='studios_news'><a href='".URL::to('/')."/family' class='smallbutton'>Семейный клуб «ДМВО»</a></li>");}
            elseif ($this_tag == 'transforce') {array_push($tags, "<li class='studios_news'><a href='".URL::to('/')."/service/transeforce' class='smallbutton'>Познавательный комплекс «Транс-Форс»</a></li>");}
            elseif ($this_tag == 'news' || $this_tag == 'exhibition') {}
            elseif (in_array($this_tag, $in_studio_array)) {
               $current_studio = Studio::where('shortname', $this_tag)->first();
               array_push($tags, "<li class='studios_news'><a href='".URL::to('/')."/studio/".$this_tag."' class='smallbutton'>".$current_studio->studio_name."</a></li>");
            }
         }
      }

      $files = Storage::disk('images');
      $photos = $files->allFiles('/events/id'.$id);
      $attachments = Attachment::where('event_id', '=', $id)
         ->get();

      return View::make('event')
         ->with('adminlink', $adminlink)
         ->with('attachments', $attachments)
         ->with('photos', $photos)
         ->with('tags', $tags)
         ->with('event', $event);
   }

}
