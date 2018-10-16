@extends('master')

@section('title', $title)
@section('scripts')
   <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
   <script>$(document).ready(function() {$('.menu-button').click(function() {$('nav').slideToggle();}); });</script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/chosen/chosen.css">
   <script src="{{URL::to('/')}}/public/js/chosen/chosen.jquery.js"></script>
   <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

  {!! Form::open(['url' => URL::current(), 'enctype' => 'multipart/form-data' ]) !!}
   <table class="admintable">
      <tr><td>{!! Form::label('studio_name', 'Название') !!}</td><td>{!! Form::text('studio_name', $content->studio_name) !!}</td></tr>
      <tr><td>{!! Form::label('shortname', 'Короткое имя') !!}</td><td>{!! Form::text('shortname', $content->shortname) !!}</td></tr>
      <tr><td>{!! Form::label('age_min', 'Возраст') !!}</td><td>{!! Form::text('age_min', $content->age_min, ['style' => 'display: inline-block; width: 30px;']) !!} – {!! Form::text('age_max', $content->age_max, ['style' => 'display: inline-block; width: 30px;']) !!}</td></tr>
      <tr><td>{!! Form::label('price', 'Стоимость') !!}</td><td>{!! Form::text('price', $content->price) !!}</td></tr>
      <tr><td>Руководитель</td><td>
         <select class='chosen-people' name='teacher[]' multiple>
            <option value=''></option>
            <?php $allteachers = explode(', ', $content->teacher); ?>
            <?php foreach ($peoplelist as $teacher): ?>
               <option value='<?php echo $teacher->id; ?>' <?php if (in_array($teacher->id, $allteachers)) {echo "selected";} ?>><?php echo $teacher->name; ?></option>
            <?php endforeach; ?>
         </select>
         <script>$('.chosen-people').chosen({ search_contains: true });</script>
      </td></tr>
      <tr><td>{!! Form::label('phone', 'Телефон') !!}</td><td>{!! Form::text('phone', $content->phone, ['placeholder' => '321-00-03']) !!}</td></tr>
      <tr><td>{!! Form::label('room', 'Кабинет') !!}</td><td>{!! Form::text('room', $content->room, ['style' => 'width: 100px;']) !!}</td></tr>
      <tr><td>{!! Form::label('link', 'Ссылка на сайт') !!}</td><td>{!! Form::text('link', $content->link) !!}</td></tr>
      <tr><td>{!! Form::label('direction', 'Теги') !!}</td><td>
         <select class='chosen-select' name='direction[]' multiple>
            <option value=''></option>
            <?php $alltags = explode(' ', $content->direction); ?>
            <option value='vocal' <?php if (in_array('vocal', $alltags)) {echo "selected";} ?>>Вокал</option>
            <option value='dance' <?php if (in_array('dance', $alltags)) {echo "selected";} ?>>Танцы</option>
            <option value='fizra' <?php if (in_array('fizra', $alltags)) {echo "selected";} ?>>Спорт</option>
            <option value='theatre' <?php if (in_array('theatre', $alltags)) {echo "selected";} ?>>Театр</option>
            <option value='music' <?php if (in_array('music', $alltags)) {echo "selected";} ?>>Музыка</option>
            <option value='poetry' <?php if (in_array('poetry', $alltags)) {echo "selected";} ?>>Слово</option>
            <option value='izo' <?php if (in_array('izo', $alltags)) {echo "selected";} ?>>ИЗО</option>
            <option value='family' <?php if (in_array('family', $alltags)) {echo "selected";} ?>>Семья</option>
            <option value='patriot' <?php if (in_array('patriot', $alltags)) {echo "selected";} ?>>Патриотика</option>
            <option value='psy' <?php if (in_array('psy', $alltags)) {echo "selected";} ?>>Психология</option>
         </select>
         <script>$('.chosen-select').chosen({ search_contains: true });</script>
      </td></tr>
      <tr><td>Описание<br /><input type="radio" id="showtext1" name="whattoshow1" checked><label for="showtext1">текст</label><input type="radio" name="whattoshow1" id="showhtml1"><label for="showhtml1">html</label></td><td><div class="mycontent1" contenteditable></div>{!! Form::textarea('content', $content->content, ['class' => 'hiddenarea1']) !!}</td></tr>
      <tr><td>Расписание<br /><input type="radio" id="showtext2" name="whattoshow2" checked><label for="showtext2">текст</label><input type="radio" name="whattoshow2" id="showhtml2"><label for="showhtml2">html</label></td><td><div class="mycontent2" contenteditable></div>{!! Form::textarea('timetable', $content->timetable, ['class' => 'hiddenarea2']) !!}</td></tr>

      <tr><td>{!! Form::label('achievements', 'Достижения') !!}</td><td>{!! Form::text('achievements', $content->achievements, ['style' => 'height: 45px;']) !!}</td></tr>
      <tr><td>Удалить студию?</td><td>
         <select name="show_or_not">
            <option <?php if ($content->show_or_not == 0) {echo "selected";} ?> value ="0">Нет</option>
            <option <?php if ($content->show_or_not == 1) {echo "selected";} ?> value ="1">Удалить</option>
         </select></td></tr>
      <tr><td>Фотографии</td><td><input name="upload_photos[]" type="file" multiple="true" /></td></tr>
   </table>

   <div class="photo_news">
   @if($photos != '[]')
      @foreach ($photos as $photo)
         <div class="deletephoto" style="background-image: url(/public/img/{{ $photo }});"><button class="delete" value="{{$content->shortname}}/{{ $photo }}">x</button></div>
      @endforeach
   @endif
   </div>
   {!! Form::submit('Изменить студию') !!}
   {!! Form::close() !!}

<script>$('button').click(function(e) { e.preventDefault(); var whatToDel = $(this).val().substr(18); $.ajax({type: "GET", url: "../../admin/deleteStudioPhoto/"+whatToDel}); $(this).parent().fadeOut(); });</script>

<script src="{{URL::to('/')}}/public/js/wyseditor.js"></script>
<script>
   new ContentEditor(1, true);
   new ContentEditor(2, true);
</script>

@endsection
