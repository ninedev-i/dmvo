<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Meta;
use App\User;

class PageData {
   public $title;
   public $description;
   public $people = [];
}

class ApiPages extends Controller {
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
      $psyPage = Page::where('id', 12)->first();
      $people = Meta::where('id', 2)->first();
      $peopleArr = explode(', ', $people['data']);

      $PageData = new PageData();
      $PageData->title = $psyPage['title'];
      $PageData->description = $psyPage['content'];
      $PageData->people = User::whereIn('id', $peopleArr)
                              ->orderByRaw('FIELD(id,'.$people['data'].')')
                              ->get(['id', 'name', 'info', 'username', 'phone', 'position']);

      return json_encode($PageData);
   }

   // Страница семейного клуба
   public function get_family_page() {
      $psyPage = Page::where('id', 25)->first();
      $people = Meta::where('id', 3)->first();
      $peopleArr = explode(', ', $people['data']);

      $PageData = new PageData();
      $PageData->title = $psyPage['title'];
      $PageData->description = $psyPage['content'];
      $PageData->people = User::whereIn('id', $peopleArr)
                              ->orderByRaw('FIELD(id,'.$people['data'].')')
                              ->get(['id', 'name', 'info', 'username', 'phone', 'position']);

      return json_encode($PageData);
   }
}
