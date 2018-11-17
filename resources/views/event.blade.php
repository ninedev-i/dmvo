@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
@endsection

@section('title', $event->title)

@section('content')
   {!! $adminlink !!}
   <p><b>Когда:</b>
   <?php
   if ($event->rus_date('F', strtotime($event->date_to) ) == $event->rus_date('F', strtotime($event->date_from) ) && $event->rus_date('j', strtotime($event->date_to) ) != $event->rus_date('j', strtotime($event->date_from) )) {
      echo $event->rus_date('j', strtotime( $event->date_from ))."-".$event->rus_date('j', strtotime( $event->date_to ));
      echo " ".$event->rus_date('F', strtotime( $event->date_from ));
   }
   else {
      echo $event->rus_date('j F', strtotime( $event->date_from ) );
      if ($event->date_from != $event->date_to) {echo ' - '.$event->rus_date('j F', strtotime($event->date_to) ); }
   }
   echo " ".$event->rus_date('Y', strtotime($event->date_to));
   if ($event->what_time) { echo ', '.$event->what_time; } ?></p>

   <?php
   if ( !$event->content && !$event->post_reliz ) {echo "Информации пока нет";}
   if ( $event->post_reliz && Input::get('show') != 'anons' ) {
      if (file_exists("img/events/covers/event_id".$event->id.".jpg")) {
         echo "<a href='".URL::to('public/img/events/covers')."/event_id".$event->id.".jpg' data-fancybox><img src='".URL::to('public/img/events/covers')."/event_id".$event->id.".jpg' style='width: 250px; float: right; margin: 0 15px 15px 15px;' alt='".$event->title."' title='".$event->title."'></a>";
      }
      if ($event->content) {
         echo "<p><b>Пост-релиз</b> <a href='".URL::to('events/'.$event->id.'?show=anons')."' style='margin-left: 10px;'>Анонс</a></p>";
      }
      echo "<main>".$event->post_reliz."</main>";
   } else {
      if ($event->post_reliz) {echo "<p><a href='".URL::to('events/'.$event->id)."' style='margin-right: 10px;'>Пост-релиз</a> <b>Анонс</b></p>";}
      if (file_exists("img/events/covers/event_id".$event->id.".jpg")) {echo "<a href='".URL::to('public/img/events/covers')."/event_id".$event->id.".jpg' data-fancybox><img src='".URL::to('public/img/events/covers')."/event_id".$event->id.".jpg' style='width: 300px; float: right; margin: 0 15px 15px 15px;' alt='".$event->title."' title='".$event->title."'></a>";}
      echo "<main>".$event->content."</main>";
   }
   ?>
   <div id="app">
      @if(!$isWideScreen)
         <attachments data="{{$attachments}}" eventId="{{$event->id}}"></attachments>
      @endif
   </div>
   <div class="photo_news">
      @if($photos != '[]')
         @foreach ($photos as $photo)
            <a href="{{ URL::to('/') }}/public/img/{{ $photo }}" data-fancybox="gallery">
               <img src="{{ URL::to('/') }}/public/img/{{ $photo }}" class="photo{{ $loop->iteration }} photo_of_event" alt="{{$event->title}}" title="{{$event->title}}">
            </a>
         @endforeach
      @endif
   </div>
   <?php
   if (sizeof($tags) > 0) {
      echo "<p><b>Упомянутые студии:</b></p>";
      foreach($tags as $tag) {
         echo $tag;
      }
   }
   ?>
   <div class="clear"></div>
   <script src="{{URL::to('/')}}/public/js/app.js"></script>
@endsection
