@extends('master')

@section('title', $title)
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script>$(document).ready(function() {$('.menu-button').click(function() {$('nav').slideToggle();}); });</script>
@section('content')

<a href="{{URL::to('/')}}/profile">Профиль</a><br /><br />
<a href="{{URL::to('/')}}/admin/addevent">Добавить мероприятие</a><br />
<a href="{{URL::to('/')}}/admin/editevent">Редактировать мероприятие</a><br /><br />
<a href="{{URL::to('/')}}/admin/addstudio">Добавить студию</a><br />
<a href="{{URL::to('/')}}/admin/editstudio">Редактировать студию</a><br /><br />
<a href="{{URL::to('/')}}/admin/addpeople">Добавить педагога</a><br />
<a href="{{URL::to('/')}}/admin/editpeople">Редактировать педагога</a><br /><br />
<a href="{{URL::to('/')}}/admin/editpage">Редактировать страницу</a><br /><br />
<a href="{{URL::to('/')}}/admin/addmassmedia">Добавить событие в раздел «СМИ о нас»</a><br /><br />
<a href="https://mysql42.hostland.ru/" target="_blank">База данных MySql</a><br /><br />

@endsection
