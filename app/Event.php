<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Event extends Model {

   // Миниатюра мероприятия
   public function photoPreview() {
      $files = Storage::disk('images')->files('/events/id'.$this->id);

      if(file_exists('../public/img/events/covers/event_id'.$this->id.'.jpg')) {
         return '<div style="background-image: url(/public/img/events/covers/event_id'.$this->id.'.jpg);" class="articleimg"></div>';
      }
      elseif(sizeof($files) != 0) {
         return '<div style="background-image: url(/public/img/'.current($files).');" class="articleimg"></div>';
      } else {
         return '<div style="background-image: url(/public/img/logo.png);" class="noarticleimg"></div>';
      }
   }

   // Короткая версия контента
   public function shortDescription() {
      if ($this->post_reliz) {
         $text = $this->post_reliz;
      } elseif ($this->content) {
         $text = $this->content;
      } else {
         $text = '';
      }
      return str_replace(array("<p>", "</p>", "<br />", "<b>", "</b>", "<i>", "</i>") , ' ', strip_tags( implode( ' ', array_slice( explode( ' ', $text ), 0, 31 ) ).'...' ) );
   }

   public function rus_date() {
      $translate = array( "January" => "января", "Jan" => "Янв", "February" => "февраля", "Feb" => "Фев", "March" => "марта", "Mar" => "Мар", "April" => "апреля", "Apr" => "Апр", "May" => "Мая", "May" => "мая", "June" => "июня", "Jun" => "Июн", "July" => "июля", "Jul" => "Июл", "August" => "августа", "Aug" => "Авг", "September" => "сентября", "Sep" => "Сен", "October" => "октября", "Oct" => "Окт", "November" => "ноября", "Nov" => "Ноя", "December" => "декабря", "Dec" => "Дек", "st" => "ое", "nd" => "ое", "rd" => "е", "th" => "ое" );
      if (func_num_args() > 1) {
         $timestamp = func_get_arg(1);
         return strtr(date(func_get_arg(0), $timestamp), $translate);
      } else {
         return strtr(date(func_get_arg(0)), $translate);
      }
   }

   public function imageWidth() {
      $width = '';
      $height = '';
      $img = public_path('img/events/covers/event_id'.$this->id.'.jpg');
      if(file_exists($img)) {
         $width = Image::make($img)->width();
         $height = Image::make($img)->height();
      }
      if ($width > $height) {
         $percent = $height/250;
         return $width/$percent;
      }
   }

}
