@extends('master')

@section('title', $people->name )

@section('content')
   {!! $adminlink !!}

   <?php
   if (file_exists(public_path("/img/users/".$people->username.".jpg"))) {
      echo "<img src='/public/img/users/".$people->username.".jpg' style='float: right; width: 300px; padding: 10px;'>";
   }
   ?>

   @foreach($studiolist as $studio)
      <p><a href='{{URL::to('/')}}/studio/{{ $studio->shortname }}'>{{ $studio->studio_name }}</a></p>
   @endforeach
   {!! $people->bio !!}


   @if($control == true)
   <h3>Расписание</h3>
   <a href="http://доммолодежи.рф/downloadExcel/xls/{{$people->id}}" class="smallbutton" style="float: left;">Выгрузить в Excel</a>

   <table class="profileTimetable">
      <tr>
         <th width="100">Дата</th>
         <th width="150">Длительность, ч.</th>
         <th>Место</th>
         <th>Вид занятости</th>
         <th>Примечание</th>
      </tr>
      @if(sizeof($timetable) == 0)
      <tr><td colspan="5">Здесь пока нет записей</td></tr>
      @endif
      @foreach($timetable as $deal)
      <tr>
         <td>{{ date('d.m.y', strtotime($deal->which_date)) }}</td>
         <td>{{ $deal->how_much_time }}</td>
         <td>{{ $deal->what_place }}</td>
         <td>{{ $deal->what_was_doing }}</td>
         <td>{{ $deal->comment }}</td>
      </tr>
      @endforeach
   </table>
   @endif

   <div class='clear'></div>
@endsection
