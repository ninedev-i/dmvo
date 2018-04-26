<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>
  <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/public/css/styles.css" />
  <link rel="shortcut icon" href="{{URL::to('/')}}/public/favicon.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
@yield('scripts')
  <script>$(function(){$(".menu-button").click(function(){$("nav").slideToggle();});});</script>
</head>
<body>
<header>
  <div class="logo">
	<a href="{{URL::to('/')}}">
		<img src="{{URL::to('/')}}/public/img/logo3.png" alt="Дом молодежи Василеостровского района" title="Дом молодежи Василеостровского района">
	</a>
  </div>
  <div class="menu-button">Меню</div>
  <nav>
  @foreach ($menu as $menu_item => $url)
  <a href="{{URL::to('/')}}/{{ $url }}"><li<?php if(Route::currentRouteName() === $url) {echo ' class="current"';}?>>{{ $menu_item }}</li></a>
  @endforeach
  </nav>
</header>

<div class="page">
    <h1>@yield('title')</h1>
    @yield('content')
</div>
<footer>
   <div class="changesize"><button id="changewordsize" class="smallbutton">Версия для слабовидящих</button><button id="changewordsize1" class="smallbutton">Обычная версия</button></div>
   <address itemscope itemtype="http://schema.org/Organization">СПб ГБУ «Дом молодёжи Василеостровского района Санкт-Петербурга», <span itemprop="streetAddress">Большой просп. В.О., 65, лит. А</span>, тел. <span itemprop="telephone">321-47-49</span>, <a href="mailto:dmvo@bk.ru" itemprop="email">dmvo@bk.ru</a></address>
</footer>
</body>
<script src="{{URL::to('/')}}/public/js/js.cookie.js"></script>
<script> $(document).ready(function() { var ourCookie = Cookies.get('blind'); if(ourCookie == "true") { $("body").css("font-size", "24px"); $("#changewordsize1").css("display", "inline-block"); $("#changewordsize").css("display", "none"); } $("#changewordsize").click(function() { Cookies.set('blind', "true", { expires: 7 }); location.reload(); }); $("#changewordsize1").click(function() { Cookies.remove('blind'); location.reload(); }); }); </script>
<script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter20854627 = new Ya.Metrika({ id:20854627, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/20854627" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</html>
