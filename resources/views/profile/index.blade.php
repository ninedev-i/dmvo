@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
@endsection

@section('title', $user->name)
@section('content')

   @if($control == false)
   <i class="adminpanel">
      <a href="{{URL::to('/')}}/profile/edit">Редактировать профиль</a>
      <a href="{{URL::to('/')}}/logout" style="margin-left: 10px;">Выйти</a>
   </i>
   @endif

   <?php
      if (file_exists(public_path("/img/users/".$user->username.".jpg"))) {
         echo "<img src='/public/img/users/".$user->username.".jpg' style='float: right; height: 200px; padding: 0px 10px 10px 0px;'>";
      }
   ?>
   {!! $user->bio !!}
   <div class="clear"></div>

   @if($control == false)
   <h3>Расписание</h3>
   <div id="checkIe" style="color: red; font-weight: bold;"></div>

   @if(sizeOf($timetable) >= 10)
      <div class='smallbutton' data-fancybox data-src="#hidden-content">Добавить занятие в расписание</div>
   @endif
   <table class="profileTimetable">
      <tr>
         <th width="100">Дата</th>
         <th width="150">Длительность, ч.</th>
         <th>Место</th>
         <th>Вид занятости</th>
         <th>Примечание</th>
      </tr>
      @foreach($timetable as $deal)
      <tr data-fancybox data-src="#hidden-content-id-{{ $deal->id }}">
         <td>{{ date('d.m.y', strtotime($deal->which_date)) }}</td>
         <td>{{ $deal->how_much_time }}</td>
         <td>{{ $deal->what_place }}</td>
         <td>{{ $deal->what_was_doing }}</td>
         <td>{{ $deal->comment }}</td>
      </tr>
      @endforeach
      <tr>
         <td colspan="5" style="background-color: white;"><div class='smallbutton' data-fancybox data-src="#hidden-content">Добавить занятие в расписание</div></td>
      </tr>
   </table>

   @foreach($timetable as $deal1)
   <div style="display: none;" id="hidden-content-id-{{ $deal1->id }}">

      {!! Form::open(['url' => 'http://доммолодежи.рф/profile/timetableupdate', 'style' => 'width: 900px;' ]) !!}
      {!! Form::hidden('timetable_id', $deal1->id, ['style' => 'display: inline-block; height: 19px;']) !!}
      <table class="admintable">
         <tr><td>{!! Form::label('timetable_date', 'Дата:') !!}</td><td>{!! Form::date('timetable_date', $deal1->which_date, ['style' => 'display: inline-block; height: 19px;']) !!} {!! Form::label('timetable_time', 'Длительность (часов): ', ['style' => 'display: inline-block;']) !!} {!! Form::number('timetable_time', $deal1->how_much_time, ['style' => 'display: inline-block; height: 19px;', 'step' => '0.01']) !!}</td></tr>
         <tr><td>{!! Form::label('timetable_deal1', 'Вид занятости:') !!}</td><td> {!! Form::text('timetable_other', $deal1->what_was_doing, ['id' => 'timetable_other', 'style' => 'display: inline; width: 672px; height: 19px;']) !!} </td></tr>
         <tr><td>{!! Form::label('timetable_place', 'Место:') !!}</td><td>{!! Form::text('timetable_place', $deal1->what_place, ['style' => 'height: 19px; width: 672px;']) !!}</td></tr>
         <tr><td>{!! Form::label('timetable_comment', 'Примечание:') !!}</td><td>{!! Form::textarea('timetable_comment', $deal1->comment, ['style' => 'display: inline-block; height: 50px;']) !!}</td></tr>
         <tr><td colspan="2" style="text-align: center;">{!! Form::submit('Изменить', ['name' => 'post_or_del']) !!} {!! Form::submit('Удалить', ['name' => 'post_or_del', 'id' => 'changewordsize']) !!}</td></tr>
      </table>
      {!! Form::close() !!}
   </div>
   @endforeach

   @endif


<div style="display: none;" id="hidden-content">
{!! Form::open(['url' => URL::current(), 'style' => 'width: 900px;' ]) !!}
<table class="admintable">
   <tr><td>{!! Form::label('timetable_date', 'Дата:') !!}</td><td>{!! Form::date('timetable_date', '', ['style' => 'display: inline-block; height: 19px;', 'required' => 'required']) !!} {!! Form::label('timetable_time', 'Длительность (часов): ', ['style' => 'display: inline-block;']) !!} {!! Form::number('timetable_time', '', ['style' => 'display: inline-block; height: 19px;', 'step' => '0.01', 'required' => 'required']) !!}</td></tr>
   <tr><td>{!! Form::label('timetable_deal', 'Вид занятости:') !!}</td><td>  {!! Form::select('timetable_deal', ['Подготовка занятия' => 'Подготовка занятия', 'Репетиция' => 'Репетиция', 'Участие в конкурсе/фестивале' => 'Участие в конкурсе/фестивале', 'Выездные выступления' => 'Выездные выступления', 'Повышение квалификации' => 'Повышение квалификации', 'Открытые занятия/мастер-класс' => 'Открытые занятия/мастер-класс', 'Иное' => 'Иное'], '', ['style' => 'display: inline;', 'required' => 'required']) !!} {!! Form::text('timetable_other', '', ['id' => 'timetable_other', 'disabled' => 'disabled', 'style' => 'display: inline; width: 369px; height: 19px;']) !!}</td></tr>
   <tr><td>{!! Form::label('timetable_place', 'Место:') !!}</td><td>{!! Form::text('timetable_place', '', ['style' => 'height: 19px;']) !!}</td></tr>
   <tr><td>{!! Form::label('timetable_comment', 'Примечание:') !!}</td><td>{!! Form::textarea('timetable_comment', '', ['style' => 'display: inline-block; height: 50px;']) !!}</td></tr>
   <tr><td colspan="2" style="text-align: center;">{!! Form::submit('Добавить') !!}</td></tr>
</table>
{!! Form::close() !!}
</div>

<script>
   $('#timetable_deal').on('change', function(e){
      if( $('#timetable_deal').val() == 'Иное') {
         $('#timetable_other').prop('disabled', false).focus();
      } else { $('#timetable_other').prop('disabled', true); }
   });
</script>

<script>
var version = detectIE();

if (version) {
  document.getElementById('checkIe').innerHTML = 'Вы используете устаревший браузер – функции электронного дневника в нем не работают. Рекомендуем использовать современный <a href="https://www.google.ru/chrome" target="_blank">браузер Google Chrome</a>.';
}

function detectIE() {
  var ua = window.navigator.userAgent;

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }
  return false;
}
</script>
@endsection
