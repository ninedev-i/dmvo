<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Event;
use App\Studio;
use App\User;
use Auth;
use URL;
use DB;

class Studios extends Controller {

// Страница со списком студий
   public function renderStudioPage() {
      $title = 'Студии и секции дома молодежи Василеостровского района';

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel">
                          <a href="admin/addstudio">Добавить новую студию</a>
                          <a href="admin/editstudio" style="margin-left: 10px;">Список всех студий</a>
                       </i>';
      } else {$adminlink = '';}


      $patriotstudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%patriot%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $vocalstudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%vocal%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $izostudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%izo%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $poetrystudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%poetry%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $fizrastudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%fizra%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $theaterstudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%theatre%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $dancestudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%dance%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $musicstudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%music%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $familystudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%family%')
         ->orderBy('studio_name', 'asc')
         ->get();
      $psystudios = Studio::where('show_or_not', '=', '0')
         ->where('direction', 'LIKE', '%psy%')
         ->orderBy('studio_name', 'asc')
         ->get();

      return View::make('studio')
         ->with('title', $title)
         ->with('adminlink', $adminlink)
         ->with('vocalstudios', $vocalstudios)
         ->with('poetrystudios', $poetrystudios)
         ->with('izostudios', $izostudios)
         ->with('fizrastudios', $fizrastudios)
         ->with('theaterstudios', $theaterstudios)
         ->with('dancestudios', $dancestudios)
         ->with('musicstudios', $musicstudios)
         ->with('familystudios', $familystudios)
         ->with('patriotstudios', $patriotstudios)
         ->with('psystudios', $psystudios);
   }

   public function renderCurrentStudioPage($shortname) {
      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editstudio/'.$shortname.'">Редактировать студию</a></i>';
      } else {$adminlink = '';}

      $studio = Studio::where('shortname', $shortname)
         // ->leftJoin('user', 'studio.teacher', '=', 'user.id')
         ->where('studio.show_or_not', '=', '0')
         ->first();

      $participationInEvents = Event::where('tags', 'LIKE', '%'.$shortname.'%')
         ->orderBy('date_to', 'desc')
         ->where('show_or_not', '=', '0')
         ->paginate(5);

      $files = Storage::disk('images');
      $photos = $files->allFiles('/studio/'.$shortname);

      $teachers = '';
      $studio_teachers = explode(', ', $studio->teacher);
      foreach($studio_teachers as $teacher_id) {
         $people = User::where('id', $teacher_id)
         ->first();
         $teacher_photo = '';
         if(file_exists(public_path('img/users/'.$people->username.'.jpg'))) {
            $teacher_photo = '<img src="'.URL::to('/').'/public/img/users/'.$people->username.'.jpg" style="width: 100%;">';
         }
         $teachers .= '<a href="'.URL::to('/').'/about/people/'.$people->id.'">'.$teacher_photo.$people->name.'</a><br />';
      }

      return View::make('studiocurrent')
         ->with('participationInEvents', $participationInEvents)
         ->with('photos', $photos)
         ->with('teachers', $teachers)
         ->with('adminlink', $adminlink)
         ->with('studio', $studio);
   }

   // Поиск по студиям
   public function searchStudioPage($studioDirection, $studioPrice, $studioAge) {
      $title = 'Поиск по студиям';

      if ($studioPrice == 'all') {
         $studios = Studio::where('show_or_not', '=', '0')
            ->where('direction', 'LIKE', '%'.$studioDirection.'%')
            ->where('age_min', '<=', $studioAge)
            ->where('age_max', '>=', $studioAge)
            ->orderBy('studio_name', 'asc')
            ->get();
      } elseif ($studioPrice == 'бесплатно') {
         $studios = Studio::where('show_or_not', '=', '0')
            ->where('direction', 'LIKE', '%'.$studioDirection.'%')
            ->where('age_min', '<=', $studioAge)
            ->where('age_max', '>=', $studioAge)
            ->where('price', 'LIKE', 'бесплатно')
            ->orderBy('studio_name', 'asc')
            ->get();
      } else {
         $studios = Studio::where('show_or_not', '=', '0')
            ->where('direction', 'LIKE', '%'.$studioDirection.'%')
            ->where('age_min', '<=', $studioAge)
            ->where('age_max', '>=', $studioAge)
            ->where('price', 'NOT LIKE', 'бесплатно')
            ->orderBy('studio_name', 'asc')
            ->get();
      }

      return View::make('studiosearch')
         ->with('title', $title)
         ->with('studioPrice', $studioPrice)
         ->with('studioAge', $studioAge)
         ->with('studioDirection', $studioDirection)
         ->with('studios', $studios);
   }

}
