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

class Online extends Controller {

   public function renderOnlinePage() {

      $page = DB::table('pages')
         ->where('id', '12')
         ->first();

      $events = Event::where('post_reliz', '!=', '')
         ->where('tags', 'LIKE', '%online%')
         ->where('show_or_not', '0')
         ->orderBy('date_to', 'desc')
         ->paginate(10);

      if (Auth::check() && Auth::user()->id == 1) {
      $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/12">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('online')
         ->with('adminlink', $adminlink)
         ->with('events', $events)
         ->with('page', $page);
   }

   public function MailToOnline(Request $request){
      $data = [
         'name' => $request['name'],
         'email' => $request['email'],
         'phone' => $request['phone'],
         'textmessage' => $request['textmessage']
      ];
      Mail::send('emails/sendmail', $data, function ($message) {
         $message->from('mail@xn--d1aadekogaqcb.xn--p1ai', 'Дом молодежи');
         $message->to('evshin.1994@inbox.r')->subject('Сообщение с сайта – Волонтеркий центр');
         $message->bcc('master-vva@narod.ru', 'Копия письма с ДМВО');
         // $message->to('master-vva@narod.ru')->subject('Сообщение с сайта – психологическая служба!');
      });
   }

}
