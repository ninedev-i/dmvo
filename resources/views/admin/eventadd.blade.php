@extends('master')

@section('title', $title)
@section('scripts')
   <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
   <script>$(document).ready(function() {$('.menu-button').click(function() {$('nav').slideToggle();}); });</script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/chosen/chosen.css">
   <script src="{{URL::to('/')}}/public/js/chosen/chosen.jquery.js"></script>
@endsection

@section('content')

  {!! Form::open(['url' => URL::current(), 'enctype' => 'multipart/form-data' ]) !!}
  <table class="admintable">
    <tr><td>{!! Form::label('date_from', 'Когда') !!}</td><td>{!! Form::date('date_from', '', ['required' => 'required']) !!} - {!! Form::date('date_to', '') !!} в {!! Form::time('what_time', '') !!}</td></tr>
    <tr><td>{!! Form::label('title', 'Название') !!}</td><td>  {!! Form::text('title', '', ['required' => 'required']) !!}</td></tr>
    <tr><td>Анонс<br /><input type="radio" id="showtext1" name="whattoshow1" checked><label for="showtext1">текст</label><input type="radio" name="whattoshow1" id="showhtml1"><label for="showhtml1">html</label></td><td><div class="mycontent1" contenteditable></div>{!! Form::textarea('content', '', ['class' => 'hiddenarea1']) !!}</td></tr>
    <tr><td>Пост-релиз<br /><input type="radio" id="showtext2" name="whattoshow2" checked><label for="showtext2">текст</label><input type="radio" name="whattoshow2" id="showhtml2"><label for="showhtml2">html</label></td><td><div class="mycontent2" contenteditable></div>{!! Form::textarea('post_reliz', '', ['class' => 'hiddenarea2']) !!}</td></tr>
    <tr><td>Студии и теги</td><td>
      <select class='chosen-select' name='tags[]' multiple>
         <option value=''></option>
         <option value='news'>Мероприятие не ДМВО</option>
         <option value='online'>Волонтерский центр</option>
         <option value='psychological'>Психологическая служба</option>
         <option value='familyclub'>Семейный клуб</option>
         <option value='exhibition'>Выставка, конкурс</option>
         <?php foreach ($studiolist as $studio): ?>
            <option value='<?php echo $studio->shortname ?>'><?php echo $studio->studio_name; ?></option>
         <?php endforeach; ?>
      </select>
      <script>$('.chosen-select').chosen({ search_contains: true });</script>
   </td></tr>
   <tr><td>Афиша</td><td>
      <input name="uploadFile" type="file" />
      <select name="right_column">
         <option value ="0">Не показывать на главной</option>
         <option value ="1">Показывать на главной</option>
      </select>
      <span style="margin-left: 15px;">Фото с мероприятия</span> <input name="upload_photos[]" type="file" multiple="true" /></td></tr>
  </table>

  {!! Form::submit('Добавить новость') !!}
  {!! Form::close() !!}

<script>$('button').click(function(e) { e.preventDefault(); var whatToDel = $(this).val().substr(13); $.ajax({type: "GET", url: "../../admin/deletephoto/"+whatToDel}); $(this).parent().fadeOut(); });</script>
<script src="{{URL::to('/')}}/public/js/wyseditor.js"></script>

@endsection
