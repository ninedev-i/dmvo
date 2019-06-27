<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use App\Post;
use App\Meta;
use App\Studio;
use App\User;

class PageData {
   public $title;
   public $description;
   public $people = [];
}

class Pages extends Controller {
   // Страница мероприятия
   public function get_page($id) {
      return Page::where('id', $id)->first();
   }

   // Страница психологов
   public function get_psychological_page() {
      $psyPage = Page::where('id', 11)->first();
      $people = Meta::where('id', 1)->first();
      $peopleArr = explode(', ', $people['data']);

      $PageData = new PageData();
      $PageData->title = $psyPage['title'];
      $PageData->description = $psyPage['content'];
      $PageData->people = User::whereIn('id', $peopleArr)
                              ->orderByRaw('FIELD(id,'.$people['data'].')')
                              ->get(['id', 'name', 'info', 'username', 'phone', 'position', 'reception_time']);

      return json_encode($PageData);
   }

   // Страница волонтеров
   public function get_volunteer_page() {
      $volunteerPage = Page::where('id', 12)->first();
      $people = Meta::where('id', 2)->first();
      $peopleArr = explode(', ', $people['data']);

      $PageData = new PageData();
      $PageData->title = $volunteerPage['title'];
      $PageData->description = $volunteerPage['content'];
      $PageData->people = User::whereIn('id', $peopleArr)
                              ->orderByRaw('FIELD(id,'.$people['data'].')')
                              ->get(['id', 'name', 'info', 'username', 'phone', 'position']);

      return json_encode($PageData);
   }

   // Страница семейного клуба
   public function get_family_page() {
      $familyPage = Page::where('id', 25)->first();
      $people = Meta::where('id', 3)->first();
      $peopleArr = explode(', ', $people['data']);

      $PageData = new PageData();
      $PageData->title = $familyPage['title'];
      $PageData->description = $familyPage['content'];
      $PageData->people = User::whereIn('id', $peopleArr)
                              ->orderByRaw('FIELD(id,'.$people['data'].')')
                              ->get(['id', 'name', 'info', 'username', 'phone', 'position']);

      return json_encode($PageData);
   }

   // Страница услуг
   public function get_service_page() {
      $servicePage = Page::where('id', 26)->first();

      $PageData = new PageData();
      $PageData->title = $servicePage['title'];
      $PageData->description = $servicePage['content'];

      return json_encode($PageData);
   }

   // Страница трансфорс
   public function get_transforce_page() {
      $servicePage = Page::where('id', 28)->first();
      $people = Meta::where('id', 5)->first();
      $peopleArr = explode(', ', $people['data']);

      $PageData = new PageData();
      $PageData->title = $servicePage['title'];
      $PageData->description = $servicePage['content'];
      $PageData->additional = Meta::where('id', 6)->get(['data'])->first()['data'];
      $PageData->people = User::whereIn('id', $peopleArr)
                                    ->orderByRaw('FIELD(id,'.$people['data'].')')
                                    ->get(['id', 'name', 'info', 'username', 'phone', 'position']);

      return json_encode($PageData);
   }

   // Страница контакты
   public function get_contacts() {
      $people = Meta::where('id', 4)->first();
      $peopleArr = explode(', ', $people['data']);

      $contacts = User::whereIn('id', $peopleArr)
                     ->orderByRaw('FIELD(id,'.$people['data'].')')
                     ->get(['id', 'name', 'info', 'username', 'phone', 'position', 'email']);
      return $contacts;
   }

   // Страница коллектив
   public function get_people() {
      $users = User::where('show_or_not', '!=', 'false')
                   ->orderBy('name', 'asc')
                   ->get(['id', 'username', 'name', 'users.phone', 'position', 'email', 'reception_time', 'role']);

      $studios = Studio::where('show_or_not', '=', '0')
                       ->get(['shortname', 'studio_name', 'teacher']);

      $users->map(function($user) use ($studios) {
         $user['studios'] = collect();

         foreach($studios as $studio) {
            $teachers_array = explode(', ', $studio->teacher);
            if (in_array($user->id, $teachers_array)) {
               $user['studios']->push($studio);
            }
         }
      });

      return $users;
   }
   // Страница информационный стенд
   public function get_board_posts() {
      return Post::where('tags', '=', 'board')
                   ->orderBy('date', 'desc')
                   ->get();
   }
}
