<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Event;
use Mail;
use Auth;
use URL;
use DB;

class Psychological extends Controller {

   public function renderPsychologicalPage() {

      $page = DB::table('pages')
         ->where('id', '11')
         ->first();

      $events = Event::where('post_reliz', '!=', '')
         ->where('tags', 'LIKE', '%psychological%')
         ->where('show_or_not', '0')
         ->orderBy('date_to', 'desc')
         ->paginate(10);

      $futureEvents = Event::where('show_or_not', '=', '0')
         ->where('date_to', '>=', date('Y-m-d'))
         ->where('tags', 'LIKE', '%psychological%')
         ->orderBy('date_from', 'asc')
         ->get();

      if (Auth::check() && Auth::user()->id == 1) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/11">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('psychological')
         ->with('adminlink', $adminlink)
         ->with('futureEvents', $futureEvents)
         ->with('events', $events)
         ->with('page', $page);
   }

   public function renderConsultPage() {

      $page = DB::table('pages')
         ->where('id', '14')
         ->first();

      if (Auth::check() && Auth::user()->id == 1) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/14">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

   public function renderGroupPage() {

      $page = DB::table('pages')
         ->where('id', '15')
         ->first();

      if (Auth::check() && Auth::user()->id == 1) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/15">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

   public function renderProforientationPage() {

      $page = DB::table('pages')
         ->where('id', '16')
         ->first();

      if (Auth::check() && Auth::user()->id == 1) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/16">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

   public function renderTrainingPage() {

      $page = DB::table('pages')
         ->where('id', '17')
         ->first();

      if (Auth::check() && Auth::user()->id == 1) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/17">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

   public function OrderPsy(Request $request){
      $data = [
         'name' => $request['name'],
         'email' => $request['email'],
         'phone' => $request['phone'],
         'age' => $request['age'],
         'date' => $request['date'],
         'choice' => $request['choice'],
         'specialist' => $request['specialist'],
         'textmessage' => $request['textmessage']
      ];
      Mail::send('emails/orderpsy', $data, function ($message) {
         $message->from('mail@xn--d1aadekogaqcb.xn--p1ai', 'Дом молодежи');
         $message->to('psihotdel_dmvo@mail.ru')->subject('Сообщение с сайта – Услуги психолога');
         $message->bcc('master-vva@narod.ru', 'Копия письма с ДМВО');
         // $message->replyTo($data['email'], 'Дом молодежи');
         // $message->to('master-vva@mail.ru')->subject('Сообщение с сайта – Услуги психолога');
         // $message->from($data['email'], 'Дом молодежи');
      });
   }
}
