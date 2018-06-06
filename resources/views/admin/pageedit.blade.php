@extends('master')

@section('title', $title)
@section('scripts')
   <!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet"> -->
   <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
   <!-- <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> -->
   <script>$(document).ready(function() {$('.menu-button').click(function() {$('nav').slideToggle();}); });</script>
   <!-- <link rel="stylesheet" href="{{URL::to('/')}}/public/js/chosen/chosen.css"> -->
   <!-- <script src="{{URL::to('/')}}/public/js/chosen/chosen.jquery.js"></script> -->
   <!-- include summernote css/js-->
   <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
   <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

@endsection

@section('content')
  {!! Form::open(['url' => URL::current() ]) !!}
  <table class="admintable">
    <tr><td>{!! Form::label('title', 'Заголовок страницы') !!}</td><td>{!! Form::text('title', $content->title) !!}</td></tr>
    <tr><td><input type="radio" id="showtext1" name="whattoshow1" checked><label for="showtext1">текст</label><input type="radio" name="whattoshow1" id="showhtml1"><label for="showhtml1">html</label></td><td><div class="mycontent1" style="padding: 1%; border: 1px solid #006699; width: 98%;" contenteditable></div>{!! Form::textarea('content', $content->content, ['class' => 'hiddenarea1']) !!}</td></tr><!-- для визуального редактора [ 'id' => 'summernote' ] -->
    <tr><td>{!! Form::label('current_url', 'Адрес страницы') !!}</td><td>  {!! Form::text('current_url', $content->current_url) !!}</td></tr>
  </table>
  {!! Form::submit('Изменить страницу') !!}
  {!! Form::close() !!}

  <script src="{{URL::to('/')}}/public/js/wyseditor.js"></script>
  <script>
     new ContentEditor(1, false);
  </script>
@endsection
