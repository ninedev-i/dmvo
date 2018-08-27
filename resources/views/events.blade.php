@extends('master')

@section('title', $title)

@section('content')

{!! $adminlink !!}
@foreach ($events as $event)
   <div class="event_block" <?php if(file_exists(public_path('img/events/covers/event_id'.$event->id.'.jpg'))) {echo 'style="width: '.$event->imageWidth().'px;"';} ?>>
      <a href="{{URL::to('/')}}/events/{{$event->id}}">
         <div <?php if (!file_exists(public_path('img/events/covers/event_id'.$event->id.'.jpg'))) {
            echo 'class="eventwithbg bgcolor'.substr($event->id, -1).'"';
         } else {
            echo ' style="line-height: 0px;"';
         }?>>
            @if(file_exists(public_path('img/events/covers/event_id'.$event->id.'.jpg')))
            <img src="public/img/events/covers/event_id{{ $event->id }}.jpg" title="{{ $event->title }}" alt="{{ $event->title }}">
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

@if($exhibitions != '[]')
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

@if($news != '[]')
   <h2>Городские и районные мероприятия</h2>
   <a name="city"></a>
   @foreach ($news as $new)
      <div class="event_block" <?php if(file_exists(public_path('img/events/covers/event_id'.$new->id.'.jpg'))) {echo 'style="width: '.$new->imageWidth().'px;"';} ?>>
         <a href="{{URL::to('/')}}/events/{{$new->id}}">
            <div <?php if (!file_exists(public_path('img/events/covers/event_id'.$new->id.'.jpg'))) {
               echo 'class="eventwithbg bgcolor'.substr($new->id, -1).'"';
            } else {
               echo ' style="line-height: 0px;"';
            }?>>
               @if(file_exists(public_path('img/events/covers/event_id'.$new->id.'.jpg')))
               <img src="public/img/events/covers/event_id{{ $new->id }}.jpg" title="{{ $new->title }}" alt="{{ $new->title }}">
               @else
                  <div class="event_title">{{ $new->title }}</div>
               @endif
            </div>
            <div class="date_row">
               <div class="date_info"><?php
               if ( $new->rus_date('m', strtotime( $new->date_from )) == $new->rus_date('m', strtotime( $new->date_to )) && $new->rus_date('j F', strtotime( $new->date_from )) != $new->rus_date('j F', strtotime( $new->date_to )) ) {
                  echo $new->rus_date('j', strtotime( $new->date_from ) ).'-'.$new->rus_date('j', strtotime( $new->date_to ) ).' '.$new->rus_date('F', strtotime( $new->date_from ) );
               } else {
                  echo $new->rus_date('j F', strtotime( $new->date_from ) );
                  if ($new->date_from != $new->date_to) {
                     echo ' - '.$new->rus_date('j F', strtotime($new->date_to) );
                  }
               }
               if ($new->what_time) { echo ', '.$new->what_time; }
               ?></div>
            </div>
         </a>
      </div>
   @endforeach
@endif
<p><a href="events/past"><span class='smallbutton'>Архив мероприятий</span></a></p>

@endsection
