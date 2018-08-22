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
         <div class="page" style="background-color: inherit; text-align: center;">
            <div class="logo">
               <a href="{{URL::to('/start')}}">
                  <img src="{{URL::to('/public/img/logo.svg')}}" alt="Дом молодежи Василеостровского района" title="Дом молодежи Василеостровского района">
               </a>
            </div>
            <nav>
               @foreach ($menuWide as $menu_item => $url)
                  <a href="{{URL::to('/')}}/{{ $url }}" class="startPageButton"><li>{{ $menu_item }}</li></a>
               @endforeach
            </nav>
         </div>
      </body>
   </html>
