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
         <div class="startPage" style="background-color: inherit; text-align: center;">
            <header>
               <img src="public/img/logo_start.png" class="logoHome">
            </header>
            <nav id="alldirections">
               <a href="{{URL::to('/studio')}}" class="directionStart">
                  <div class="dirimage" style="background-image: url(public/img/dance_studios.jpg); background-position: 50% 40%;"></div>
                  <h3>Студии</h3>
               </a>
               <a href="{{URL::to('/events')}}" class="directionStart">
                  <div class="dirimage" style="background-image: url(public/img/vox.jpg); background-position: 50% 30%;"></div>
                  <h3>Мероприятия</h3>
               </a>
               <a href="{{URL::to('/psychological')}}" class="directionStart">
                  <div class="dirimage" style="background-image: url(public/img/psy.jpg); background-position: 50% 00%;"></div>
                  <h3>Психологический центр</h3>
               </a>
               <a href="{{URL::to('/volunteer')}}" class="directionStart">
                  <div class="dirimage" style="background-image: url(public/img/events/id1175/UvdoQUU2io8.jpg); background-position: 50% 55%;"></div>
                  <h3>Волонтерский центр</h3>
               </a>
               <a href="{{URL::to('/family')}}" class="directionStart">
                  <div class="dirimage" style="background-image: url(public/img/family.jpg); background-position: 50% 0%;"></div>
                  <h3>Семейный клуб</h3>
               </a>
               <a href="{{URL::to('/contact')}}" class="directionStart">
                  <div class="dirimage" style="background-image: url(public/img/map.jpg);"></div>
                  <h3>Контактная информация</h3>
               </a>
            </nav>
            <footer>
               <span>321-47-49</span> <span>доммолодежи.рф</span> <span>vk.com/dom65</span> <span>instagram.com/dom65</span>
            </footer>
         </div>
      </body>
   </html>
