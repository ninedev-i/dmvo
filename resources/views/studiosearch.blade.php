@extends("master")

@section("title", $title)

@section("content")

{!! Form::open(['url' => '/studio/direction' , 'id' => 'searchForm', 'class' => 'searchform']) !!}

   {!! Form::label('studioPrice', 'Стоимость:') !!}
   {!! Form::select('studioPrice',['all' => 'Все', 'бесплатно' => 'Бесплатные занятия', 'платно' => 'Платные занятия'], $studioPrice, ['style' => 'margin-right: 10px;']) !!}

   {!! Form::label('studioDirection', 'Направление:') !!}
   {!! Form::select('studioDirection',  ['%' => 'Все', 'vocal' => 'Вокал', 'dance' => 'Танцы', 'fizra' => 'Спорт', 'theatre' => 'Театр', 'music' => 'Музыка', 'patriot' => 'Патриотика', 'poetry' => 'Слово', 'izo' => 'ИЗО', 'family' => 'Семья'], $studioDirection, ['style' => 'margin-right: 10px;']) !!}

   {!! Form::label('studioAge', 'Возраст:') !!}
   {!! Form::text('studioAge', $studioAge, ['style' => 'height: 25px; margin-right: 10px; width: 27px; padding: 5px 1%; text-align: center; display: inline-block;', 'required' => 'required']) !!}

   {!! Form::submit('Подобрать студию', ['style' => 'display: inline-block; margin-right: 0px;']) !!}
{!! Form::close() !!}

@if($studios != '[]')
   @foreach($studios as $studio)
      <li class="studio"><a href="{{URL::to('/')}}/studio/{{ $studio->shortname }}">{{$studio->studio_name}}</a></li>
   @endforeach
@else
   <p style="margin-top:20px; margin-bottom: 20px; font-weight: bold;">Студий с подобными характеристиками не найдено.</p>
@endif
<p style="margin-top: 10px;"><a href="{{URL::to('/')}}/studio"><span class="smallbutton">Вернуться ко всем студиям</span></a></p>


<script>document.getElementById('searchForm').onsubmit = function (event) { event.preventDefault(); var age = document.querySelectorAll('input[name="studioAge"]')[0]; var direction = document.querySelectorAll('select[name="studioDirection"]')[0]; var price = document.querySelectorAll('select[name="studioPrice"]')[0]; window.location.href = this.action + '=' + encodeURIComponent(direction.value) + '&price=' + encodeURIComponent(price.value) + '&age=' + age.value; };</script>

@endsection
