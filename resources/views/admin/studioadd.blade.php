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
      <tr><td>{!! Form::label('studio_name', 'Название') !!}</td><td>{!! Form::text('studio_name', '') !!}</td></tr>
      <tr><td>{!! Form::label('shortname', 'Короткое имя') !!}</td><td>{!! Form::text('shortname', '') !!}</td></tr>
      <tr><td>{!! Form::label('age_min', 'Возраст') !!}</td><td>{!! Form::text('age_min', '', ['style' => 'display: inline-block; width: 30px;']) !!} – {!! Form::text('age_max', '', ['style' => 'display: inline-block; width: 30px;']) !!}</td></tr>
      <tr><td>{!! Form::label('price', 'Стоимость') !!}</td><td>{!! Form::text('price', '') !!}</td></tr>
      <tr><td>Руководитель</td><td>
         <select class='chosen-people' name='teacher[]' multiple>
           <option value=''></option>
           <?php foreach ($peoplelist as $teacher): ?>
              <option value='<?php echo $teacher->id; ?>'><?php echo $teacher->name; ?></option>
           <?php endforeach; ?>
        </select>
        <script>$('.chosen-people').chosen({ search_contains: true });</script> <!--<span style='margin-left: 10px;'><a href='admin.php?page=people' target='_blank'>Добавить нового педагога</a></span>-->
      </td></tr>
      <tr><td>{!! Form::label('phone', 'Телефон') !!}</td><td>{!! Form::text('phone', '', ['placeholder' => '321-00-03']) !!}</td></tr>
      <tr><td>{!! Form::label('room', 'Кабинет') !!}</td><td>{!! Form::text('room', '', ['style' => 'width: 100px;']) !!}</td></tr>
      <tr><td>{!! Form::label('link', 'Ссылка на сайт') !!}</td><td>{!! Form::text('link', '') !!}</td></tr>
      <tr><td>{!! Form::label('direction', 'Теги') !!}</td><td>
         <select class='chosen-select' name='direction[]' multiple>
            <option value=''></option>
            <option value='vocal'>Вокал</option>
            <option value='dance'>Танцы</option>
            <option value='fizra'>Спорт</option>
            <option value='theatre'>Театр</option>
            <option value='music'>Музыка</option>
            <option value='poetry'>Слово</option>
            <option value='izo'>ИЗО</option>
            <option value='family'>Семья</option>
            <option value='patriot'>Патриотика</option>
            <option value='psy'>Психология</option>
         </select>
         <script>$('.chosen-select').chosen({ search_contains: true });</script>
      </td></tr>
      <tr><td>Расписание<br /><input type="radio" id="showtext" name="whattoshow" checked><label for="showtext">текст</label><input type="radio" name="whattoshow" id="showhtml"><label for="showhtml">html</label></td><td><div class="mycontent" contenteditable></div>{!! Form::textarea('timetable', '', ['class' => 'hiddenarea']) !!}</td></tr>
      <tr><td>Описание<br /><input type="radio" id="showtext1" name="whattoshow1" checked><label for="showtext1">текст</label><input type="radio" name="whattoshow1" id="showhtml1"><label for="showhtml1">html</label></td><td><div class="mycontent1" contenteditable></div>{!! Form::textarea('content', '', ['class' => 'hiddenarea1']) !!}</td></tr>
      <tr><td>{!! Form::label('achievements', 'Достижения') !!}</td><td>{!! Form::text('achievements', '', ['style' => 'height: 45px;']) !!}</td></tr>
      <tr><td>Фотографии</td><td><input name="upload_photos[]" type="file" multiple="true" /></td></tr>
   </table>
   {!! Form::submit('Добавить студию') !!}
   {!! Form::close() !!}
   
   <script src="{{URL::to('/')}}/public/js/wyseditor.js"></script>
   <script>
      new ContentEditor(1, true);
      new ContentEditor(2, true);
   </script>
@endsection
