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

class Service extends Controller {

   // Услуги
   public function renderServicePage() {
      $page = DB::table('pages')
         ->where('id', '7')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/7">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('service')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

   // Колонный зал
   public function renderColumnhallPage() {
      $page = DB::table('pages')
         ->where('id', '8')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/8">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      $youtube = "NgHOSWDkZxc";
      $video = "columnhall.mp4";
      $videoPoster = "https://i.ytimg.com/vi_webp/NgHOSWDkZxc/sddefault.webp";

      return View::make('service')
         ->with('youtube', $youtube)
         ->with('video', $video)
         ->with('videoPoster', $videoPoster)
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

   // Голубой зал
   public function renderBluehallPage() {
      $page = DB::table('pages')
         ->where('id', '9')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/9">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      $youtube = "hVYMhSeTbPc";
      $video = "bluehall.mp4";
      $videoPoster = "https://i.ytimg.com/vi_webp/hVYMhSeTbPc/sddefault.webp";

      return View::make('service')
         ->with('youtube', $youtube)
         ->with('video', $video)
         ->with('videoPoster', $videoPoster)
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

   // Трансфорс
   public function renderTransforcePage() {
      $page = DB::table('pages')
         ->where('id', '10')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/10">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      $youtube = "fdUSuqtskxs";
      $video = "transeforce.mp4";
      $videoPoster = "https://i.ytimg.com/vi_webp/fdUSuqtskxs/sddefault.webp";

      return View::make('service')
         ->with('youtube', $youtube)
         ->with('video', $video)
         ->with('videoPoster', $videoPoster)
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

   // Заказ Трансфорса
   public function OrderTf(Request $request){
      $data = [
         'organisation' => $request['organisation'],
         'fio' => $request['fio'],
         'contact' => $request['contact'],
         'textmessage' => $request['textmessage']
      ];
      Mail::send('emails/ordertfmail', $data, function ($message) {
         $message->from('mail@xn--d1aadekogaqcb.xn--p1ai', 'Дом молодежи');
         $message->to('dmvo_barskaya@bk.ru')->subject('Сообщение с сайта – заказ ТрансФорса!');
         $message->bcc('master-vva@narod.ru', 'Копия письма с ДМВО');
      });
   }
}
