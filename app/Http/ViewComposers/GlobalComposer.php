<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class GlobalComposer {

   public function compose(View $view) {
      $menu = [
         'О Доме' => 'about',
         'Мероприятия' => 'events',
         'Студии' => 'studio',
         'Услуги' => 'service',
         'Психологи' => 'psychological',
         'Волонтерский центр' => 'volunteer',
         'Семейный клуб' => 'family',
         'Контакты' => 'contact'
      ];

      $menuWide = [
         'Студии' => 'studio',
         'Мероприятия' => 'events',
         'Психологи' => 'psychological',
         'Семейный клуб' => 'family',
         'Волонтерский центр' => 'volunteer',
         'О Доме' => 'about',
         'Услуги' => 'service',
         'Контакты' => 'contact'
      ];

      $menuWithIcons = [
         'О Доме' => ['about', 'house'],
         'Мероприятия' => ['events', 'calendar'],
         'Студии' => ['studio', 'gym'],
         'Услуги' => ['service', 'certificate'],
         'Психологи' => ['psychological', 'neurology'],
         'Волонтерский центр' => ['volunteer', 'volunteer'],
         'Семейный клуб' => ['family', 'family'],
         'Контакты' => ['contact', 'smartphone']
      ];

      if (Auth::check() && Auth::user()->id != 1) {
         $menu = array_merge( [ 'Профиль' => 'profile' ], $menu );
      }


      if (Auth::check() && in_array(Auth::user()->id, [1, 65])) {
         $menu = array_merge( [ 'Админка' => 'admin' ], $menu );
      }

      $isWideScreen = strpos($_SERVER['HTTP_HOST'], 'xn--h1adbpp') === 0 ? true : false;
      $isNew = strpos($_SERVER['HTTP_HOST'], 'xn--b1aoke0e') === 0 ? true : false;

      $view->with('menu', $menu);
      $view->with('menuWide', $menuWide);
      $view->with('isWideScreen', $isWideScreen);
      $view->with('isNew', $isNew);
      $view->with('menuWithIcons', $menuWithIcons);
   }

}
