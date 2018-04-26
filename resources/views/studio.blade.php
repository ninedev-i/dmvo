@extends("master")

@section('scripts')
  <script src="{{URL::to('/')}}/public/js/masonry.js"></script>
  <script>$(document).ready(function() {$("#alldirections").masonry({itemSelector: ".direction", singleMode: false, isResizable: true, isAnimated: true, animationOptions: {queue: false, duration: 500}});});</script>
@endsection

@section("title", $title)

@section("content")
{!! $adminlink !!}

{!! Form::open(['url' => '/studio/direction' , 'id' => 'searchForm', 'class' => 'searchform']) !!}

   {!! Form::label('studioPrice', 'Стоимость:') !!}
   {!! Form::select('studioPrice', ['all' => 'Все', 'бесплатно' => 'Бесплатные занятия', 'платно' => 'Платные занятия'], null, ['style' => 'margin-right: 10px;']) !!}

   {!! Form::label('studioDirection', 'Направление:') !!}
   {!! Form::select('studioDirection',  ['%' => 'Все', 'vocal' => 'Вокал', 'dance' => 'Танцы', 'fizra' => 'Спорт', 'theatre' => 'Театр', 'music' => 'Музыка', 'patriot' => 'Патриотика', 'poetry' => 'Слово', 'izo' => 'ИЗО', 'family' => 'Семья'], null, ['style' => 'margin-right: 10px;']) !!}

   {!! Form::label('studioAge', 'Возраст:') !!}
   {!! Form::text('studioAge', null, ['style' => 'height: 25px; margin-right: 10px; width: 27px; padding: 5px 1%; text-align: center; display: inline-block;', 'required' => 'required']) !!}

   {!! Form::submit('Подобрать студию', ['style' => 'display: inline-block; margin-right: 0px;']) !!}
{!! Form::close() !!}

<div id="alldirections">
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/studio/historicalcenter/hT8QRVACLGA.jpg);"></div>
    <h3>Патриотическое направление:</h3>
    @foreach ($patriotstudios as $patriotstudio)
      <li class="studio"><a href="studio/{{ $patriotstudio->shortname }}">{{ $patriotstudio->studio_name }}<?php if ($patriotstudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';} ?></a></li>
    @endforeach
  </div>
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/studio/hand/photo_3.jpg); background-position: 50% 30%;"></div>
    <h3>Вокальное направление:</h3>
    @foreach ($vocalstudios as $vocalstudio)
      <li class="studio"><a href="studio/{{ $vocalstudio->shortname }}">{{ $vocalstudio->studio_name }}<?php if ($vocalstudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';}?></a></li>
    @endforeach
  </div>
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/studio/timelines/eMK9cM5e2X4.jpg); background-position: 50% 40%;"></div>
    <h3>Художественное слово:</h3>
    @foreach ($poetrystudios as $poetrystudio)
      <li class="studio"><a href="studio/{{ $poetrystudio->shortname }}">{{ $poetrystudio->studio_name }}<?php if ($poetrystudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';} ?></a></li>
    @endforeach
  </div>
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/studio/jog/photo_1.jpg); background-position: 50% 36%;"></div>
    <h3>Видео, ИЗО, ДПИ:</h3>
    @foreach ($izostudios as $izostudio)
      <li class="studio"><a href="studio/{{ $izostudio->shortname }}">{{ $izostudio->studio_name }}<?php if ($izostudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';} ?></a></li>
    @endforeach
  </div>
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/studio/mainstream/px7n349qrgQ.jpg); background-position: 50% 40%;"></div>
    <h3>Танцевальное направление:</h3>
    @foreach ($dancestudios as $dancestudio)
      <li class="studio"><a href="studio/{{ $dancestudio->shortname }}">{{ $dancestudio->studio_name }}<?php if ($dancestudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';} ?></a></li>
    @endforeach
  </div>
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/studio/sky/2014-2015.jpg); background-position: 50% 60%;"></div>
    <h3>Физкультурно-оздоровительное направление:</h3>
    @foreach ($fizrastudios as $fizrastudio)
      <li class="studio"><a href="studio/{{ $fizrastudio->shortname }}">{{ $fizrastudio->studio_name }}<?php if ($fizrastudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';} ?></a></li>
    @endforeach
  </div>
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/studio/ourhome/13.jpg); background-position: 50% 60%;"></div>
    <h3>Театральное направление:</h3>
    @foreach ($theaterstudios as $theatrestudio)
      <li class="studio"><a href="studio/{{ $theatrestudio->shortname }}">{{ $theatrestudio->studio_name }}<?php if ($theatrestudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';} ?></a></li>
    @endforeach
  </div>
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/studio/northcity/SeverniGorod.jpg);"></div>
    <h3>Музыкальное направление:</h3>
    @foreach ($musicstudios as $musicstudio)
      <li class="studio"><a href="studio/{{ $musicstudio->shortname }}">{{ $musicstudio->studio_name }}<?php if ($musicstudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';} ?></a></li>
    @endforeach
  </div>
  <div class="direction">
    <div class="dirimage" style="background-image: url(public/img/family.jpg); background-position: 50% 0%;"></div>
    <h3>Работа с семьями:</h3>
    @foreach ($familystudios as $familystudio)
      <li class="studio"><a href="studio/{{ $familystudio->shortname }}">{{ $familystudio->studio_name }}<?php if ($familystudio->price != "бесплатно") {echo '<span class="typefree"><img src="public/img/typenotfree.png"></span>';} ?></a></li>
    @endforeach
  </div>
</div>

<script>document.getElementById('searchForm').onsubmit = function (event) { event.preventDefault(); var age = document.querySelectorAll('input[name="studioAge"]')[0]; var direction = document.querySelectorAll('select[name="studioDirection"]')[0]; var price = document.querySelectorAll('select[name="studioPrice"]')[0]; window.location.href = this.action + '=' + encodeURIComponent(direction.value) + '&price=' + encodeURIComponent(price.value) + '&age=' + age.value; };</script>

@endsection
