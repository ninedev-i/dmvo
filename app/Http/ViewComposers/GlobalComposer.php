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


      if (Auth::check() && Auth::user()->id == 1) {
         $menu = array_merge( [ 'Админка' => 'admin' ], $menu );
      }


      $view->with('menu', $menu);
      $view->with('menuWithIcons', $menuWithIcons);

   }

}
