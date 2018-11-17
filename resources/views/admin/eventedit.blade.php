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
       <tr>
          <td>{!! Form::label('date_from', 'Когда') !!}</td>
          <td>{!! Form::date('date_from', $content->date_from) !!} - {!! Form::date('date_to', $content->date_to) !!} в {!! Form::time('what_time', $content->what_time) !!}</td>
       </tr>
       <tr>
          <td>{!! Form::label('title', 'Название') !!}</td><td>  {!! Form::text('title', $content->title) !!}</td></tr>
       <tr>
          <td>Анонс<br /><input type="radio" id="showtext1" name="whattoshow1" checked><label for="showtext1">текст</label><input type="radio" name="whattoshow1" id="showhtml1"><label for="showhtml1">html</label></td><td><div class="mycontent1" contenteditable></div>{!! Form::textarea('content', $content->content, ['class' => 'hiddenarea1']) !!}</td>
       </tr>
       <tr>
          <td>Пост-релиз<br /><input type="radio" id="showtext2" name="whattoshow2" checked><label for="showtext2">текст</label><input type="radio" name="whattoshow2" id="showhtml2"><label for="showhtml2">html</label></td><td><div class="mycontent2" contenteditable></div>{!! Form::textarea('post_reliz', $content->post_reliz, ['class' => 'hiddenarea2']) !!}</td>
       </tr>
       <tr>
          <td>Студии и теги</td>
          <td>
             <select class='chosen-select' name='tags[]' multiple>
             <option value=''></option>
             <?php $alltags = explode(' ', $content->tags); ?>
             <option value='news' <?php if (in_array('news', $alltags)) {echo "selected";} ?>>Мероприятие не ДМВО</option>
             <option value='psychological' <?php if (in_array('psychological', $alltags)) {echo "selected";} ?>>Психологическая служба</option>
             <option value='online' <?php if (in_array('online', $alltags)) {echo "selected";} ?>>Волонтерский центр</option>
             <option value='familyclub' <?php if (in_array('familyclub', $alltags)) {echo "selected";} ?>>Семейный клуб</option>
             <option value='exhibition' <?php if (in_array('exhibition', $alltags)) {echo "selected";} ?>>Выставка, конкурс</option>
             <?php foreach ($studiolist as $studio): ?>
             <option value='<?php echo $studio->shortname ?>' <?php if (in_array($studio->shortname, $alltags)) {echo "selected";} ?>><?php echo $studio->studio_name; ?></option>
             <?php endforeach; ?>
             </select>
             <script>$('.chosen-select').chosen({ search_contains: true });</script>
          </td>
       </tr>
       <tr>
          <td>Вложения</td>
          <td>
             <div id="app">
                <edit-attachments data="{{$attachments}}" eventId="{{$content->id}}"></edit-attachments>
             </div>
          </td>
       </tr>
       <tr>
          <td>Афиша</td>
          <td>
             <input name="uploadFile" type="file" />
             <select name="right_column">
                <option <?php if ($content->right_column == 0) {echo "selected ";} ?> value ="0">Не показывать на главной</option>
                <option <?php if ($content->right_column == 1) {echo "selected ";} ?> value ="1">Показывать на главной</option>
             </select>
          </td>
       </tr>
       <tr>
          <td>Фотографии</td>
          <td>
             <div class="editPhotos">
                <input name="upload_photos[]" type="file" multiple="true" />
                <div class="photo_news" >
                   @if($photos != '[]')
                      @foreach ($photos as $photo)
                         <div class="deletephoto" style="background-image: url(/public/img/{{ $photo }});"><button class="delete" value="{{$content->id}}/{{ $photo }}">x</button></div>
                      @endforeach
                   @endif
                </div>
             </div>
          </td>
       </tr>
    </table>
    
    @if($content->show_or_not == 0)
             {!! Form::submit('Изменить мероприятие') !!}
             <a href="{{URL::to('/admin/deleteevent/') .'/'. $content->id}}" class="smallbutton redbutton">Удалить мероприятие</a>
          @else
             {!! Form::submit('Восстановить мероприятие') !!}
          @endif
        {!! Form::close() !!}
        <script>
          $('button').click(function(e) { e.preventDefault(); var whatToDel = $(this).val().substr(13); $.ajax({type: "GET", url: "../../admin/deletephoto/"+whatToDel}); $(this).parent().fadeOut(); });
       </script>
       <script src="{{URL::to('/')}}/public/js/wyseditor.js"></script>
       <script>
          new ContentEditor(1, true);
          new ContentEditor(2, true);
       </script>
       <script src="{{URL::to('/')}}/public/js/app.js"></script>
    @endsection
