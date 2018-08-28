@extends('master')

@section('title', $title)

@section('content')

   {!! $adminlink !!}
   <div class="pageMenu">
      <a href="{{URL::to('/events')}}" class="smallbutton <?php if (Request::is('events')) {echo 'current';} ?>">Ближайшие</a>
      <a href="{{URL::to('/events/past')}}" class="smallbutton <?php if (Request::is('events/past')) {echo 'current';} ?>">Прошедшие</a>
      <a href="{{URL::to('/events/other')}}" class="smallbutton <?php if (Request::is('events/other')) {echo 'current';} ?>">Другие</a>
   </div>

   @foreach ($events as $event)
      <div class="event_block" <?php if(file_exists(public_path('img/events/covers/event_id'.$event->id.'.jpg'))) {echo 'style="width: '.$event->imageWidth().'px;"';} ?>>
         <a href="{{URL::to('/')}}/events/{{$event->id}}">
            <div <?php if (!file_exists(public_path('img/events/covers/event_id'.$event->id.'.jpg'))) {
               echo 'class="eventwithbg bgcolor'.substr($event->id, -1).'"';
            } else {
               echo ' style="line-height: 0px;"';
            }?>>
               @if(file_exists(public_path('img/events/covers/event_id'.$event->id.'.jpg')))
               <img src="{{URL::to('/public/img/events/covers/event_id')}}{{$event->id}}.jpg" title="{{ $event->title }}" alt="{{ $event->title }}">
               @else
                  <div class="event_title">{{ $event->title }}</div>
               @endif
            </div>
            <div class="date_row">
               <div class="date_info"><?php
               if ( $event->rus_date('m', strtotime( $event->date_from )) == $event->rus_date('m', strtotime( $event->date_to )) && $event->rus_date('j F', strtotime( $event->date_from )) != $event->rus_date('j F', strtotime( $event->date_to )) ) {
                  echo $event->rus_date('j', strtotime( $event->date_from ) ).'-'.$event->rus_date('j', strtotime( $event->date_to ) ).' '.$event->rus_date('F', strtotime( $event->date_from ) );
               } else {
                  echo $event->rus_date('j F', strtotime( $event->date_from ) );
                  if ($event->date_from != $event->date_to) {
                     echo ' - '.$event->rus_date('j F', strtotime($event->date_to) );
                  }
               }
               if ($event->what_time) { echo ', '.$event->what_time; }
               ?></div>
            </div>
         </a>
      </div>
   @endforeach
   @if(count($events) == 0)
      <p>Мероприятия еще не анонсированы</p>
   @endif

   @if(count($exhibitions) > 0)
      <h2>Конкурсы и выставки</h2>
      @foreach ($exhibitions as $exhibition)
         <div class="event_block" <?php if(file_exists(public_path('img/events/covers/event_id'.$exhibition->id.'.jpg'))) {echo 'style="width: '.$exhibition->imageWidth().'px;"';} ?>>
            <a href="{{URL::to('/')}}/events/{{$exhibition->id}}">
               <div <?php if (!file_exists(public_path('img/events/covers/event_id'.$exhibition->id.'.jpg'))) {
                  echo 'class="eventwithbg bgcolor'.substr($exhibition->id, -1).'"';
               } else {
                  echo ' style="line-height: 0px;"';
               }?>>
                  @if(file_exists(public_path('img/events/covers/event_id'.$exhibition->id.'.jpg')))
                  <img src="public/img/events/covers/event_id{{ $exhibition->id }}.jpg" title="{{ $exhibition->title }}" alt="{{ $exhibition->title }}">
                  @else
                     <div class="event_title">{{ $exhibition->title }}</div>
                  @endif
               </div>
               <div class="date_row">
                  <div class="date_info"><?php
                  if ( $exhibition->rus_date('m', strtotime( $exhibition->date_from )) == $exhibition->rus_date('m', strtotime( $exhibition->date_to )) && $exhibition->rus_date('j F', strtotime( $exhibition->date_from )) != $exhibition->rus_date('j F', strtotime( $exhibition->date_to )) ) {
                     echo $exhibition->rus_date('j', strtotime( $exhibition->date_from ) ).'-'.$exhibition->rus_date('j', strtotime( $exhibition->date_to ) ).' '.$exhibition->rus_date('F', strtotime( $exhibition->date_from ) );
                  } else {
                     echo $exhibition->rus_date('j F', strtotime( $exhibition->date_from ) );
                     if ($exhibition->date_from != $exhibition->date_to) {
                        echo ' - '.$exhibition->rus_date('j F', strtotime($exhibition->date_to) );
                     }
                  }
                  if ($exhibition->what_time) { echo ', '.$exhibition->what_time; }
                  ?></div>
               </div>
            </a>
         </div>
      @endforeach
   @endif
@endsection
