<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Studio;
use App\Event;
use DB;

class Index extends Controller {

   // Главная страница
   public function renderIndexPage() {
      $title = 'Дом молодежи Василеостровского района Санкт-Петербурга';
      $isWide = strpos($_SERVER['HTTP_HOST'], 'xn--h1adbpp') === 0;
      $mainPageTemplate = $isWide ? 'index_wide' : 'index';

      $events = Event::where('post_reliz', '!=', '')
         ->orderBy('date_to', 'desc')
         ->paginate(10);

      $photos = [];
      $studios = [];
      if ($isWide) {
         $studios = Studio::where('show_or_not', '=', '0')
            ->orderByRaw("RAND()")
            ->take(3)
            ->get();

         $randomStudiosNames = $studios->map(function ($item, $key) {
           return $item->shortname;
         });
         $files = Storage::disk('images');
         foreach ($randomStudiosNames as $key => $value) {
            $pushedPhoto = $files->allFiles('/studio/'.$value);
            $pushedPhoto = collect($pushedPhoto);
            $pushedPhoto = !$pushedPhoto->isEmpty() ? $pushedPhoto->random() : '';
            array_push($photos, $pushedPhoto);
         }
         $photos = collect($photos);
      }

      $closestEvents = Event::where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'NOT LIKE', '%news%')
         ->where('tags', 'NOT LIKE', '%exhibition%')
         ->where('show_or_not', '0')
         ->orderBy('date_from', 'asc')
         ->take(6)
         ->get();

      $exhibitions = Event::where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'NOT LIKE', '%news%')
         ->where('tags', 'LIKE', '%exhibition%')
         ->where('show_or_not', '0')
         ->orderBy('date_from', 'asc')
         ->take(6)
         ->get();

      $countCityEvents = Event::where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'LIKE', '%news%')
         ->count();

      $slider = Event::where('right_column', '=', '1')
         ->where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->orderBy('date_from', 'ASC')
         ->get();

      return View::make($mainPageTemplate)
         ->with('studios', $studios)
         ->with('photos', $photos)
         ->with('title', $title)
         ->with('slider', $slider)
         ->with('closestEvents', $closestEvents)
         ->with('countCityEvents', $countCityEvents)
         ->with('exhibitions', $exhibitions)
         ->with('events', $events);
   }

   public function renderIndexPage2() {
      $title = 'Дом молодежи Василеостровского района Санкт-Петербурга';

      $events = Event::where('post_reliz', '!=', '')
         ->orderBy('date_to', 'desc')
         ->paginate(10);

      $closestEvents = Event::where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'NOT LIKE', '%exhibition%')
         ->where('show_or_not', '0')
         ->orderBy('date_from', 'asc')
         ->take(6)
         ->get();

      $exhibitions = Event::where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'LIKE', '%exhibition%')
         ->where('show_or_not', '0')
         ->orderBy('date_from', 'asc')
         ->take(6)
         ->get();

      $slider = Event::where('right_column', '=', '1')
         ->where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->orderBy('date_from', 'ASC')
         ->get();

      return View::make('index2')
         ->with('title', $title)
         ->with('slider', $slider)
         ->with('closestEvents', $closestEvents)
         ->with('exhibitions', $exhibitions)
         ->with('events', $events);
   }

   public function renderIndexPageWideScreen() {
      $title = 'Дом молодежи Василеостровского района Санкт-Петербурга';

      $events = Event::where('post_reliz', '!=', '')
         ->orderBy('date_to', 'desc')
         ->paginate(10);

      $closestEvents = Event::where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'NOT LIKE', '%exhibition%')
         ->where('show_or_not', '0')
         ->orderBy('date_from', 'asc')
         ->take(6)
         ->get();

      $exhibitions = Event::where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'LIKE', '%exhibition%')
         ->where('show_or_not', '0')
         ->orderBy('date_from', 'asc')
         ->take(6)
         ->get();

      $slider = Event::where('right_column', '=', '1')
         ->where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->orderBy('date_from', 'ASC')
         ->get();

      return View::make('widescreen/index')
         ->with('title', $title)
         ->with('slider', $slider)
         ->with('closestEvents', $closestEvents)
         ->with('exhibitions', $exhibitions)
         ->with('events', $events);
   }

   public function renderStartPage() {
      return View::make('start');
   }
}
