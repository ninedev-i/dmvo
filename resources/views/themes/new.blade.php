<!DOCTYPE html>
<html>
   <head>
      <title>@yield('title')</title>
      <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/public/css/styles_new.css" />
      <link rel="shortcut icon" href="{{URL::to('/')}}/public/favicon.ico" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="//unpkg.com/iview/dist/styles/iview.css">
<script src="//vuejs.org/js/vue.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      @yield('scripts')
      <script>$(function(){$(".menu-button").click(function(){$("nav").slideToggle();});});</script>
      <script src="//unpkg.com/iview/dist/iview.min.js"></script>
   </head>
   <body>
      <div id="layout_con">
         <div class="ivu-layout ivu-layout-has-sider" style="min-height: 100vh;">

            <aside class="ivu-layout-sider" style="width: 250px; min-width: 250px; max-width: 250px; flex: 0 0 250px;">
               <span class="ivu-layout-sider-zero-width-trigger" style="display: none;"><i class="ivu-icon ivu-icon-ios-menu"></i></span>
               <div class="ivu-layout-sider-children ivu-affix">
                  <div class="logo">
                     <a href="http://xn--d1aadekogaqcb.xn--p1ai">
                        <img src="http://xn--d1aadekogaqcb.xn--p1ai/public/img/logo_white.png" alt="Дом молодежи Василеостровского района" title="Дом молодежи Василеостровского района">
                     </a>
                  </div>

                  <nav class="ivu-menu ivu-menu-dark ivu-menu-vertical menu-item" style="width: auto;">
                     @foreach ($menu as $menu_item => $url)
                        <a href="{{URL::to('/')}}/{{ $url }}" class="ivu-menu-item <?php if(Route::currentRouteName() === $url) {echo 'ivu-menu-item-selected ivu-menu-item-active';}?>"><!--<i class="ivu-icon ivu-icon-ios-navigate"></i>--> <span>{{ $menu_item }}</span></a>
                     @endforeach
                  </nav>
               </div>
               <div class="ivu-layout-sider-trigger" style="width: 200px;">
                  <i class="ivu-icon ivu-icon-ios-arrow-back ivu-layout-sider-trigger-icon"></i>
               </div>
            </aside>

            <main class="ivu-layout">
               <div class="ivu-layout-content" style="padding: 0px 16px 16px;">

                  <div class="ivu-card ivu-card-bordered">
                     <div class="ivu-card-body">
                        <h1>@yield('title')</h1>
                        @yield('content')
                     </div>
                  </div>
               </div>

               <footer>
                  <div class="changesize">
                     <button id="changewordsize" class="smallbutton">Версия для слабовидящих</button><button id="changewordsize1" class="smallbutton">Обычная версия</button>
                  </div>
                  <address itemscope itemtype="http://schema.org/Organization">
                     СПб ГБУ «Дом молодёжи Василеостровского района Санкт-Петербурга», <span itemprop="streetAddress">Большой просп. В.О., 65, лит. А</span>, тел. <span itemprop="telephone">321-47-49</span>, <a href="mailto:dmvo@bk.ru" itemprop="email">dmvo@bk.ru</a>
                  </address>
               </footer>
            </main>

            <aside class="" style="width: 350px; min-width: 350px; max-width: 350px; flex: 0 0 350px;">
               тут боковуха
               <div id="app">
                  <qwerty></qwerty>
               </div>
            </aside>
         </div>
      </div>
   </body>


   <!-- <script src="{{URL::to('/')}}/public/js/js.cookie.js"></script>
   <script> $(document).ready(function() { var ourCookie = Cookies.get('blind'); if(ourCookie == "true") { $("body").css("font-size", "24px"); $("#changewordsize1").css("display", "inline-block"); $("#changewordsize").css("display", "none"); } $("#changewordsize").click(function() { Cookies.set('blind', "true", { expires: 7 }); location.reload(); }); $("#changewordsize1").click(function() { Cookies.remove('blind'); location.reload(); }); }); </script>
   <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter20854627 = new Ya.Metrika({ id:20854627, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/20854627" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->
</html>
