<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Event;
use DB;

class Index extends Controller {

   // Главная страница
   public function renderIndexPage() {
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

      return View::make('index')
      ->with('title', $title)
      ->with('slider', $slider)
      ->with('closestEvents', $closestEvents)
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
}
