<!DOCTYPE html>
<html>
   <head>
      <title>@yield('title')</title>
      <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/public/css/styles_wide_screen.css" />
      <link rel="shortcut icon" href="{{URL::to('/')}}/public/favicon.ico">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      @yield('scripts')
   </head>
   <body>
      <header>
         <div class="logo">
            <a href="{{URL::to('/start')}}">
               <img src="{{URL::to('/public/img/logo.svg')}}" alt="Дом молодежи Василеостровского района" title="Дом молодежи Василеостровского района">
            </a>
         </div>
         <div class="menu-button">Меню</div>
         <nav>
            @foreach ($menuWide as $menu_item => $url)
               <a href="{{URL::to('/')}}/{{ $url }}"><li<?php if(Route::currentRouteName() === $url) {echo ' class="current"';}?>>{{ $menu_item }}</li></a>
            @endforeach
         </nav>
      </header>

      <div class="page">
         <h1>@yield('title')</h1>
         @yield('content')
      </div>
      <footer>
         <address itemscope itemtype="http://schema.org/Organization">СПб ГБУ «Дом молодёжи Василеостровского района Санкт-Петербурга», <span itemprop="streetAddress">Большой просп. В.О., 65, лит. А</span>, тел. <span itemprop="telephone">321-47-49</span>, <a href="mailto:dmvo@bk.ru" itemprop="email">dmvo@bk.ru</a></address>
      </footer>
   </body>
   <script src="{{URL::to('/')}}/public/js/back_to_main_page.js"></script>
</html>
