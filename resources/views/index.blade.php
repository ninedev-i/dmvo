@extends('master')

@section('scripts')
  <script src="{{URL::to('/')}}/public/js/jquery.scrollbox.js"></script>
  <script>$(document).ready(function(){ $('#demo5').scrollbox({direction: 'h',distance: 134}); $('#back').click(function () {$('#demo5').trigger('backward');}); $('#next').click(function () {$('#demo5').trigger('forward');});});</script>
@endsection

@section('title', $title)

@section('content')

<button class="sliderbutton back" id="back"></button>
<div id='demo5' class='slider'>
<ul>
   @foreach ($slider as $slider_item)
      <li><a href="{{URL::to('/')}}/events/{{$slider_item->id}}"><img src="public/img/events/covers/event_id{{$slider_item->id}}.jpg" alt="{{ $slider_item->title }}" title="{{ $slider_item->title }}" /></a></li>
   @endforeach
   <li><a href="{{URL::to('/')}}/studio/fitnes"><img src="public/img/fitness2.jpg" alt="Тренажерный зал" title="Тренажерный зал"></a></li>
   <li><a href="https://vk.com/dom65" target="_blank"><img src="public/img/vk.jpg" alt="Группа Дома молодежи вконтакте" title="Тренажерный зал"></a></li>
</ul>
</div>
<button class="sliderbutton next" id="next"></button>

@if($closestEvents != '[]')
   <h2 class="mainpagetitle"><a href='{{URL::to('/')}}/events'>Ближайшие мероприятия</a></h2>
   <ul class="old_events">
   @foreach ($closestEvents as $closestEvent)
      <li>
         <div style="padding-left: 15px;"><a href="{{URL::to('/')}}/events/{{ $closestEvent->id }}">
            <?php
            if ( $closestEvent->rus_date('m', strtotime( $closestEvent->date_from )) == $closestEvent->rus_date('m', strtotime( $closestEvent->date_to )) && $closestEvent->rus_date('j F', strtotime( $closestEvent->date_from )) != $closestEvent->rus_date('j F', strtotime( $closestEvent->date_to )) ) {
               echo $closestEvent->rus_date('j', strtotime( $closestEvent->date_from ) ).'-'.$closestEvent->rus_date('j', strtotime( $closestEvent->date_to ) ).' '.$closestEvent->rus_date('F', strtotime( $closestEvent->date_from ) );
            } else {
               echo $closestEvent->rus_date('j F', strtotime( $closestEvent->date_from ) );
               if ($closestEvent->date_from != $closestEvent->date_to) {
                  echo ' - '.$closestEvent->rus_date('j F', strtotime($closestEvent->date_to) );
               }
            }
            if ($closestEvent->what_time) { echo ', '.$closestEvent->what_time; }
            ?>
         </a>
         </div>
         <a href="{{URL::to('/')}}/events/{{ $closestEvent->id }}">{{ $closestEvent->title }}</a>
      </li>
   @endforeach
   </ul>
@endif

@if($exhibitions != '[]')
   <h2 class="mainpagetitle">Конкурсы и выставки</h2>
   <ul class="old_events">
   @foreach ($exhibitions as $exhibition)
      <li>
         <div style="padding-left: 15px;"><a href="events/{{ $exhibition->id }}"><?php
         if ( $exhibition->rus_date('m', strtotime( $exhibition->date_from )) == $exhibition->rus_date('m', strtotime( $exhibition->date_to )) && $exhibition->rus_date('j F', strtotime( $exhibition->date_from )) != $exhibition->rus_date('j F', strtotime( $exhibition->date_to )) ) {
            echo $exhibition->rus_date('j', strtotime( $exhibition->date_from ) ).'-'.$exhibition->rus_date('j', strtotime( $exhibition->date_to ) ).' '.$exhibition->rus_date('F', strtotime( $exhibition->date_from ) );
         } else {
            echo $exhibition->rus_date('j F', strtotime( $exhibition->date_from ) );
            if ($exhibition->date_from != $exhibition->date_to) {
               echo ' - '.$exhibition->rus_date('j F', strtotime($exhibition->date_to) );
            }
         }
         if ($exhibition->what_time) { echo ', '.$exhibition->what_time; }
         ?>
      </a></div>
         <a href="{{URL::to('/')}}/events/{{ $exhibition->id }}">{{ $exhibition ->title }}</a>
      </li>
   @endforeach
   </ul>
@endif

<a href="http://журнал.доммолодежи.рф/" target="_blank">
   <h2 class="mainpagetitle">Молодёжный онлайн-журнал В@ська</h2>
   <img src="http://журнал.доммолодежи.рф/img/logo.png" height="80" alt="Молодёжный онлайн-журнал В@ська" title="Молодёжный онлайн-журнал В@ська">
</a>

<h2 class="mainpagetitle">Важные ссылки</h2>
<div>
  <a href="http://voadm.spb.ru/" style="margin-right: 25px;" rel="nofollow" target="blank"><img src="{{URL::to('/public/img/admvo.jpg')}}"></a>
  <a href="http://gov.spb.ru/gov/otrasl/kpmp/" style="margin-right: 25px;" rel="nofollow" target="blank"><img src="{{URL::to('/public/img/commol.jpg')}}"></a>
  <a href="https://tvoybudget.spb.ru/ " rel="nofollow" target="blank"><img src="{{URL::to('/public/img/budget.jpg')}}"></a>
  <!-- <a href="http://spbtolerance.ru/" rel="nofollow" target="blank"><img src="{{URL::to('/public/img/tolerance.jpg')}}"></a> -->
  <a href="http://www.zakon.gov.spb.ru/hot_line" rel="nofollow" target="blank"><img src="{{URL::to('/public/img/corrupt.jpg')}}"></a>
  <!-- <a href="about.php?page=gosuslugi" rel="nofollow" target="blank"><img src="{{URL::to('/public/img/gosuslugi.png')}}"></a> -->
  <!-- <a href="http://www.xn--c1adbjbwilr5m.xn--p1ai/" rel="nofollow" target="blank"><img src="{{URL::to('/public/img/heroname.jpg')}}"></a> -->
</div>

@if($countCityEvents > 0)
   <a href="{{URL::to('/events/other')}}"><h2 class="mainpagetitle">Городские и районные мероприятия</h2></a>
@endif

<div id="content">
<h2>Новости</h2>
  @foreach ($events as $events_item)
    <article>
      <a href="{{URL::to('/')}}/events/{{$events_item->id}}">
        {!! $events_item->photoPreview() !!}
        <p class="news-title">{{ $events_item->title }}</p>
        <p>{{ $events_item->shortDescription() }}</p>
      </a>
    </article>
  @endforeach

   {{ $events->fragment('content')->links() }}
 </div>

@endsection
