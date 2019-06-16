<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class Mails extends Controller {
   // Письмо психологам
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

   // Письмо трансфорс
   public function mail_transforce(Request $request) {
      $data = [
         'organisation' => $request['organisation'],
         'email' => $request['email'],
         'phone' => $request['phone'],
         'fio' => $request['fio'],
         'message' => $request['message'],
         'show' => $request['show']
      ];
      Mail::send('emails/ordertransforce', $data, function($message) {
         $message->from('mail@xn--d1aadekogaqcb.xn--p1ai', 'Дом молодежи');
         $message->to('trance-fors@mail.ru')->subject('Сообщение с сайта – Заявка на посещение трансфорс');
         $message->bcc('master-vva@narod.ru', 'Копия письма с ДМВО');
      });

      return 'true';
   }

   // Письмо волонтеры
   public function mail_volunteer(Request $request) {
      $data = [
         'name' => $request['name'],
         'email' => $request['email'],
         'phone' => $request['phone'],
         'message' => $request['message']
      ];
      Mail::send('emails/ordervolunteer', $data, function($message) {
         $message->from('mail@xn--d1aadekogaqcb.xn--p1ai', 'Дом молодежи');
         $message->to('levshin.1994@inbox.ru')->subject('Сообщение с сайта – Письмо в волонтерский центр');
         $message->bcc('master-vva@narod.ru', 'Копия письма с ДМВО');
      });

      return 'true';
   }
}
