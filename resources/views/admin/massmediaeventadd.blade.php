@extends('master')

@section('title', $title)
@section('scripts')
   <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
   <script>$(document).ready(function() {$('.menu-button').click(function() {$('nav').slideToggle();}); });</script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/chosen/chosen.css">
   <script src="{{URL::to('/')}}/public/js/chosen/chosen.jquery.js"></script>
   <script src="{{URL::to('/')}}/public/js/wyseditor.js"></script>
@endsection

@section('content')

  {!! Form::open(['url' => URL::current(), 'enctype' => 'multipart/form-data' ]) !!}
  <table class="admintable">
    <tr><td>{!! Form::label('date', 'Когда') !!}</td><td>{!! Form::date('date', '') !!}</td></tr>
    <tr><td>{!! Form::label('owner', 'Чья статья') !!}</td><td>  {!! Form::text('owner', '') !!}</td></tr>
    <tr><td>{!! Form::label('link', 'Ссылка') !!}</td><td>  {!! Form::text('link', '', ['required' => 'required']) !!}</td></tr>
    <tr><td>{!! Form::label('title', 'Название') !!}</td><td>  {!! Form::text('title', '', ['required' => 'required']) !!}</td></tr>
    <tr><td>Контент<br /><input type="radio" id="showtext" name="whattoshow" checked><label for="showtext">текст</label><input type="radio" name="whattoshow" id="showhtml"><label for="showhtml">html</label></td><td><div class="mycontent" contenteditable></div>{!! Form::textarea('content', '', ['class' => 'hiddenarea']) !!}</td></tr>
  </table>

  {!! Form::submit('Добавить мероприятие') !!}
  {!! Form::close() !!}


@endsection
