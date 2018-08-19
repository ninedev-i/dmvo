@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/jquery.scrollbox.js"></script>
   <script>$(document).ready(function(){ $('#demo5').scrollbox({direction: 'h',distance: 134}); $('#back').click(function () {$('#demo5').trigger('backward');}); $('#next').click(function () {$('#demo5').trigger('forward');});});</script>
@endsection

@section('title', $title)

@section('content')
   @if($studios != '[]')
      <h2 class="mainpagetitle"><a href='{{URL::to('/')}}/studio'>Список случайных студий</a></h2>
      <div class="studioContainer direction">
         @foreach ($studios as $studio)
            <div class="studio">
               <a href="{{URL::to('/')}}/studio/{{ $studio->shortname }}">
                  <div class="dirimage <?php if ($photos[$loop->iteration - 1] == '') {echo 'bgcolor'.$loop->iteration;}?>" style="background-image: url('{{URL::to('/public/img/'.$photos[$loop->iteration - 1])}}');"></div>
                  <h3 class="ellipsis">{{ $studio->studio_name }}</h3>
                  <div class="info">
                     <b>Возраст:</b> от {{ $studio->age_min }} до {{ $studio->age_max }} лет<br />
                     @if ( $studio->price )
                        <div class="ellipsis"><b>Стоимость:</b> {!! $studio->price !!}</div>
                     @endif
                  </div>
               </a>
            </div>
         @endforeach
      </div>
      <a href="{{URL::to('/')}}/studio" class="smallbutton" style="margin: 20px 0;">Смотреть все студии</a>

   @endif

   <h2 class="mainpagetitle"><a href='{{URL::to('/')}}/events'>Ближайшие мероприятия</a></h2>
   <div class="clear"> </div>
   <button class="sliderbutton back" id="back"></button>
   <div id='demo5' class='slider'>
      <ul>
         @foreach ($slider as $slider_item)
            <li><a href="{{URL::to('/')}}/events/{{$slider_item->id}}"><img src="public/img/events/covers/event_id{{$slider_item->id}}.jpg" alt="{{ $slider_item->title }}" title="{{ $slider_item->title }}" /></a></li>
         @endforeach
         <li><a href="{{URL::to('/')}}/studio/fitnes"><img src="public/img/fitness.jpg" alt="Тренажерный зал"></a></li>
      </ul>
   </div>
   <button class="sliderbutton next" id="next"></button>
   <a href="{{URL::to('/')}}/events" class="smallbutton" style="margin: 20px 0;">Смотреть все мероприятия</a>

   <!-- @if($closestEvents != '[]')
      <h2 class="mainpagetitle"><a href='{{URL::to('/')}}/events'>Ближайшие мероприятия</a></h2>
      <ul class="old_events">
         @foreach ($closestEvents as $closestEvent)
            <li>
               <div style="padding-left: 15px;">
                  <a href="{{URL::to('/')}}/events/{{ $closestEvent->id }}">
                     <?php
                     // if ( $closestEvent->rus_date('m', strtotime( $closestEvent->date_from )) == $closestEvent->rus_date('m', strtotime( $closestEvent->date_to )) && $closestEvent->rus_date('j F', strtotime( $closestEvent->date_from )) != $closestEvent->rus_date('j F', strtotime( $closestEvent->date_to )) ) {
                     //    echo $closestEvent->rus_date('j', strtotime( $closestEvent->date_from ) ).'-'.$closestEvent->rus_date('j', strtotime( $closestEvent->date_to ) ).' '.$closestEvent->rus_date('F', strtotime( $closestEvent->date_from ) );
                     // } else {
                     //    echo $closestEvent->rus_date('j F', strtotime( $closestEvent->date_from ) );
                     //    if ($closestEvent->date_from != $closestEvent->date_to) {
                     //       echo ' - '.$closestEvent->rus_date('j F', strtotime($closestEvent->date_to) );
                     //    }
                     // }
                     // if ($closestEvent->what_time) { echo ', '.$closestEvent->what_time; }
                     ?>
                  </a>
               </div>
               <a href="{{URL::to('/')}}/events/{{ $closestEvent->id }}">{{ $closestEvent->title }}</a>
            </li>
         @endforeach
      </ul>
   @endif -->

   <!-- @if($exhibitions != '[]')
      <h2 class="mainpagetitle">Конкурсы и выставки</h2>
      <ul class="old_events">
         @foreach ($exhibitions as $exhibition)
            <li>
               <div style="padding-left: 15px;"><a href="events/{{ $exhibition->id }}"><?php
               // if ( $exhibition->rus_date('m', strtotime( $exhibition->date_from )) == $exhibition->rus_date('m', strtotime( $exhibition->date_to )) && $exhibition->rus_date('j F', strtotime( $exhibition->date_from )) != $exhibition->rus_date('j F', strtotime( $exhibition->date_to )) ) {
               //    echo $exhibition->rus_date('j', strtotime( $exhibition->date_from ) ).'-'.$exhibition->rus_date('j', strtotime( $exhibition->date_to ) ).' '.$exhibition->rus_date('F', strtotime( $exhibition->date_from ) );
               // } else {
               //    echo $exhibition->rus_date('j F', strtotime( $exhibition->date_from ) );
               //    if ($exhibition->date_from != $exhibition->date_to) {
               //       echo ' - '.$exhibition->rus_date('j F', strtotime($exhibition->date_to) );
               //    }
               // }
               // if ($exhibition->what_time) { echo ', '.$exhibition->what_time; }
               ?>
            </a></div>
               <a href="{{URL::to('/')}}/events/{{ $exhibition->id }}">{{ $exhibition ->title }}</a>
            </li>
         @endforeach
      </ul>
   @endif -->

   <div id="content">
   <h2>Отчеты о прошедших мероприятиях</h2>
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
