<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\Timetable;
use App\Studio;
use App\People;
use App\Media;
use App\User;
use Auth;
use URL;
use DB;

class PagesController extends Controller  {


   // О доме молодежи – разводящая страница
   public function about() {
      $page = DB::table('pages')
      ->where('id', '18')
      ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/18">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('aboutpage2')
      ->with('adminlink', $adminlink)
      ->with('page', $page);
   }


   // О Доме Молодежи
   public function info() {
      $page = DB::table('pages')
         ->where('id', '19')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/19">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }


   // Материальная база
   public function halls() {
      $page = DB::table('pages')
         ->where('id', '22')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/22">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }


   // Коллектив
   public function teamInfo() {
      $content = DB::table('pages')
         ->where('id', '2')
         ->first();
      $people = User::where('show_or_not', '!=', 'false')
         ->limit(0)
         ->get();
      $currentLink = 'team';

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/2">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('aboutteachers2')
         ->with('adminlink', $adminlink)
         ->with('title', $content->title)
         ->with('currentLink', $currentLink)
         ->with('content', $content->content)
         ->with('people', $people);
   }


         // Отдельно взятый педагог
         public function currentPeople($id) {
            $people = User::where('id', $id)
               ->where('show_or_not', 'true')
               ->first();

            $studiolist = Studio::where('teacher', 'like' , $id)
               ->where('show_or_not', '=', '0')
               ->get();

            $timetable = Timetable::where('user_id', $id)
               ->orderBy('which_date', 'asc')
               ->get();

            $control = false;
            if ((Auth::check() && Auth::user()->role == 'control') || (Auth::check() && Auth::user()->id == '1')) {
               $control = true;
            }

            if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
               $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpeople/'.$id.'">Редактировать педагога</a></i>';
            } else {$adminlink = '';}

            return View::make('peoplecurrent')
               ->with('adminlink', $adminlink)
               ->with('timetable', $timetable)
               ->with('control', $control)
               ->with('studiolist', $studiolist)
               ->with('people', $people);
         }


         // Руководство
         public function aboutAdministration() {
            $title = 'Руководство дома молодежи';
            $people = User::where('show_or_not', '!=', 'false')
               ->where('role', 'like', '%administration%')
               ->orderByRaw(DB::raw('FIELD(id, 57, 48, 58, 59, 60, 61, 84, 52, 63, 64, 65, 55)'))
               ->get();
            $currentLink = 'administration';
            $content = '';
            $showStudios = false;
            $adminlink = '';

            return View::make('aboutteachers2')
               ->with('adminlink', $adminlink)
               ->with('title', $title)
               ->with('currentLink', $currentLink)
               ->with('content', $content)
               ->with('showStudios', $showStudios)
               ->with('people', $people);
         }

         // Педагоги
         public function aboutTeachers() {
            $title = 'Руководители студий дома молодежи';
            $people = User::with('studio')
               ->where('show_or_not', '!=', 'false')
               ->where('role', 'like', '%teacher%')
               ->orderBy('name', 'asc')
               ->get();

            $currentLink = 'teachers';
            $content = '';
            $showStudios = true;
            $adminlink = '';

            return View::make('aboutteachers2')
               ->with('adminlink', $adminlink)
               ->with('title', $title)
               ->with('currentLink', $currentLink)
               ->with('content', $content)
               ->with('showStudios', $showStudios)
               ->with('people', $people);
         }

         // Специалисты
         public function aboutSpecialists() {
            $title = 'Специалисты дома молодежи';
            $people = User::where('show_or_not', '!=', 'false')
               ->where('role', 'like', '%specialist%')
               ->orderBy('name', 'asc')
               ->get();
            $currentLink = 'specialists';
            $content = '';
            $showStudios = false;
            $adminlink = '';

            return View::make('aboutteachers2')
               ->with('adminlink', $adminlink)
               ->with('title', $title)
               ->with('currentLink', $currentLink)
               ->with('content', $content)
               ->with('showStudios', $showStudios)
               ->with('people', $people);
         }


   // Формы молодежного досуга
   public function studio() {
      $page = DB::table('pages')
         ->where('id', '23')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/23">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }


   // История здания
   public function history() {
      $page = DB::table('pages')
         ->where('id', '20')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/20">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }


   // Волонтерство
   public function volunteer() {
      $page = DB::table('pages')
         ->where('id', '21')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/21">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }


   // Информационный стенд
   public function board() {
      $page = DB::table('pages')
         ->where('id', '13')
         ->first();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/13">Редактировать страницу</a></i>';
      } else {$adminlink = '';}

      return View::make('page')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }


   // СМИ о нас
   public function massMedia() {
      $title = 'СМИ о нас';
      $list = Media::orderBy('date', 'desc')
         ->get();

      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/addmassmedia">Добавить новость СМИ</a></i>';
      } else {$adminlink = '';}

      return View::make('massmedia')
         ->with('list', $list)
         ->with('adminlink', $adminlink)
         ->with('title', $title);
   }

         public function massMediaCurrent($id) {
            $media = Media::where('id', $id)
               ->where('show_or_not', 'true')
               ->first();

            if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
               $adminlink = '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editmassmedia/'.$id.'">Редактировать новость СМИ</a> <a href="'.URL::to('/').'/about/massmedia/" style="margin-left: 10px;">Список новостей СМИ</a></i>';
            } else {$adminlink = '';}

            return View::make('mediacurrent')
               ->with('adminlink', $adminlink)
               ->with('media', $media);
         }

   // Контакты
   public function contacts() {
      $page = DB::table('pages')
         ->where('id', '6')
         ->first();

      $adminlink = (Auth::check() && in_array(Auth::user()->id, [1, 65]) ? '<i class="adminpanel"><a href="'.URL::to('/').'/admin/editpage/6">Редактировать страницу</a></i>' : '');

      return View::make('contact')
         ->with('adminlink', $adminlink)
         ->with('page', $page);
   }

}
