@extends('master')

@section('title', $title)
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script>$(document).ready(function() {$('.menu-button').click(function() {$('nav').slideToggle();}); });</script>
@section('content')

<a href="{{URL::to('/')}}/profile">Профиль</a><br /><br />
<a href="{{URL::to('/')}}/admin/addevent">Добавить мероприятие</a><br />
<a href="{{URL::to('/')}}/admin/editevent">Список всех мероприятий</a><br /><br />
<a href="{{URL::to('/')}}/admin/addstudio">Добавить студию</a><br />
<a href="{{URL::to('/')}}/admin/editstudio">Список всех студий</a><br /><br />
<!-- <a href="{{URL::to('/')}}/admin/addpeople">Добавить педагога</a><br /> -->
<!-- <a href="{{URL::to('/')}}/admin/editpeople">Редактировать педагога</a><br /><br /> -->
<a href="{{URL::to('/')}}/admin/editpage">Список всех страниц</a><br /><br />
<!-- <a href="{{URL::to('/')}}/admin/addmassmedia">Добавить событие в раздел «СМИ о нас»</a><br /><br /> -->
<a href="https://metrika.yandex.ru/dashboard?id=20854627" target="_blank">Яндекс метрика</a><br /><br />
<a href="https://nostromo.beget.com/phpMyAdmin/index.php" target="_blank">База данных MySql</a><br /><br />

@endsection
