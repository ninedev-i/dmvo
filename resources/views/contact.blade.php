@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
@endsection

@section('title', $page->title)

@section('content')
   {!! $adminlink !!}
   <p>Санкт-Петербургское государственное бюджетное учреждение «Дом молодежи Василеостровского района Санкт-Петербурга»</p>
   <p>Адрес: Санкт-Петербург, Большой проспект В.О., дом 65 лит. А</p>
   @if (!$isWideScreen )
      <p>E-mail: <a href="mailto:dmvo@bk.ru">dmvo@bk.ru</a></p>
      <p><a href="http://vk.com/dom65" target="_blank">Группа ВКонтакте</a></p>
      <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A91ad2419068d1b477709a229fb8362ed04037472f8fc6e8a513c614a08a7fe86&amp;width=100%25&amp;height=310&amp;lang=ru_RU&amp;scroll=true"></script>
   @endif

   <main>
      {!! $page->content !!}
   </main>
@endsection
