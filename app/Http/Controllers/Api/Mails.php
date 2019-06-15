<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class Mails extends Controller {
   // Направления со студиями
   public function mail_psy(Request $request) {
      $data = [
         'name' => $request['name'],
         'email' => $request['email'],
         'phone' => $request['phone'],
         'age' => $request['age'],
         'date' => $request['date'],
         'choice' => $request['direction'],
         'specialist' => $request['specialist'],
         'textmessage' => $request['message']
      ];
      Mail::send('emails/orderpsy', $data, function ($message) {
         $message->from('mail@xn--d1aadekogaqcb.xn--p1ai', 'Дом молодежи');
         $message->to('psihotdel_dmvo@mail.ru')->subject('Сообщение с сайта – Услуги психолога');
         $message->bcc('master-vva@narod.ru', 'Копия письма с ДМВО');
      });

      return 'true';
   }
}
