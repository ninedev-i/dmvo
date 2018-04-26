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
    <tr><td>{!! Form::label('date', 'Когда') !!}</td><td>{!! Form::date('date', $content->date) !!}</td></tr>
    <tr><td>{!! Form::label('owner', 'Чья статья') !!}</td><td>  {!! Form::text('owner', $content->owner) !!}</td></tr>
    <tr><td>{!! Form::label('link', 'Ссылка') !!}</td><td>  {!! Form::text('link', $content->link, ['required' => 'required']) !!}</td></tr>
    <tr><td>{!! Form::label('title', 'Название') !!}</td><td>  {!! Form::text('title', $content->title, ['required' => 'required']) !!}</td></tr>
    <tr><td>Контент<br /><input type="radio" id="showtext" name="whattoshow" checked><label for="showtext">текст</label><input type="radio" name="whattoshow" id="showhtml"><label for="showhtml">html</label></td><td><div class="mycontent" contenteditable></div>{!! Form::textarea('content', $content->content, ['class' => 'hiddenarea']) !!}</td></tr>
    <tr><td>Удалить новость?</td><td>
      <select name="show_or_not">
          <option <?php if ($content->show_or_not == 'true') {echo "selected";} ?> value ="true">Нет</option>
          <option <?php if ($content->show_or_not == 'false') {echo "selected";} ?> value ="false">Удалить</option>
      </select></td></tr>
  </table>

  {!! Form::submit('Изменить новость СМИ') !!}
  {!! Form::close() !!}


@endsection
