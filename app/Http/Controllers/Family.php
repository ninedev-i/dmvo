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

class Family extends Controller {

   public function renderFamilyPage() {

      $page = DB::table('pages')
         ->where('id', '25')
         ->first();

      $events = Event::where('post_reliz', '!=', '')
         ->where('tags', 'LIKE', '%familyclub%')
         ->where('show_or_not', '0')
         ->orderBy('date_to', 'desc')
         ->paginate(10);

      if (Auth::check() && in_array(Auth::user()->id, [1, 57, 63, 90])) {
      $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/25">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('family')
         ->with('adminlink', $adminlink)
         ->with('events', $events)
         ->with('page', $page);
   }

   // public function MailToOnline(Request $request){
   //    $data = [
   //       'name' => $request['name'],
   //       'email' => $request['email'],
   //       'phone' => $request['phone'],
   //       'textmessage' => $request['textmessage']
   //    ];
   //    Mail::send('emails/sendmail', $data, function ($message) {
   //       $message->from('mail@xn--d1aadekogaqcb.xn--p1ai', 'Дом молодежи');
   //       $message->to('boxgirl@yandex.ru')->subject('Сообщение с сайта – психологическая служба!');
   //       $message->bcc('master-vva@narod.ru', 'Копия письма с ДМВО');
   //       // $message->to('master-vva@narod.ru')->subject('Сообщение с сайта – психологическая служба!');
   //    });
   // }

}
