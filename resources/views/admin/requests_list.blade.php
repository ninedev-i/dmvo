@extends('master')

@section('title', $title)
   <meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
   <div id="app">
      <table class="servicetable" id="requestsTable">
         <tr style="background-color: #006699; color: white;">
            <td>№</td>
            <td>Имя</td>
            <td>Возраст</td>
            <td>Телефон</td>
            <td>Студия</td>
            <td>Время заявки</td>
            <td></td>
         </tr>
         @foreach ($allRequests as $request)
            <tr id="line_{{$request->id}}">
               <td>{{$loop->iteration}}</td>
               <td>{{$request->name}}</td>
               <td>{{$request->calculateAge($request->birthday) ? $request->calculateAge($request->birthday) : '-'}}</td>
               <td>{{$request->phone}}</td>
               <td><a href="{{URL::to('/studio/'.$request->studio)}}">{{$request->getStudio ? $request->getStudio->studio_name : 'Студия не найдена'}}</a></td>
               <td>{{date("d.m.y, H:i",strtotime($request->request_date))}}</td>
               <td><studio-request-finish-button id="{{$request->id}}"></studio-request-finish-button></td>
            </tr>
         @endforeach
         <tr class="<?php if (count($allRequests)) {echo 'hidden';}?>">
            <td colspan="7" style="text-align: center; padding: 10px;">Нет необработанных заявок</td>
         </tr>
      </table>

      <h3 style="margin-top: 30px;">Обработанные заявки</h3>
      <table class="servicetable" id="finishedTable">
         <tr style="background-color: #006699; color: white;">
            <td>№</td>
            <td>Имя</td>
            <td>Возраст</td>
            <td>Телефон</td>
            <td>Студия</td>
            <td>Время обработки заявки</td>
         </tr>
         @foreach ($finishedRequests as $request)
            <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$request->name}}</td>
               <td>{{$request->calculateAge($request->birthday) ? $request->calculateAge($request->birthday) : '-'}}</td>
               <td>{{$request->phone}}</td>
               <td><a href="{{URL::to('/studio/'.$request->studio)}}">{{$request->getStudio ? $request->getStudio->studio_name : 'Студия не найдена'}}</a></td>
               <td>{{date("d.m.y, H:i",strtotime($request->request_date))}}</td>
            </tr>
         @endforeach
         @if(!count($finishedRequests))
            <tr class="emptyRow">
               <td colspan="6" style="text-align: center; padding: 10px;">Нет заявок</td>
            </tr>
         @endif
      </table>
   </div>
   <script src="{{URL::to('/')}}/public/js/app.js"></script>
@endsection
