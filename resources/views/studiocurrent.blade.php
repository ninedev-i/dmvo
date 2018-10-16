@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
@endsection

@section('title', $studio->studio_name)

@section('content')

{!! $adminlink !!}
<div class="bytheway">
    <b>Возраст:</b> от {{ $studio->age_min }} до {{ $studio->age_max }} лет<br />
    @if ( $studio->price )
      <b>Стоимость:</b> {!! $studio->price !!}<br />
    @endif
    @if ( $studio->room )
      <b>Кабинет:</b> {{ $studio->room}}<br />
    @endif
    <b>Руководитель:</b><br />

    <?php $studio_teachers = explode(', ', $studio->teacher);?>
    {!! $teachers !!}
    @if ( $studio->phone )
      {!! $studio->phone !!}<br />
    @endif
    @if ( $studio->link && !$isWideScreen )
      <div class="site_link"><a href="{{$studio->link}}" title="{{$studio->link}}" target="_blank" class="site_link">{{ $studio->link }}</a></div>
    @endif
</div>
  {!! $studio->content !!}
  @if ( $studio->timetable )
    <p><b>Расписание:</b></p> {!! $studio->timetable !!}
  @endif

  <div class="photostudio">

    @if($photos != '[]')
      @foreach ($photos as $photo)
        <a href="{{ URL::to('/') }}/public/img/{{ $photo }}" data-fancybox="gallery">
           <img src="{{ URL::to('/') }}/public/img/{{ $photo }}" class="photo{{ $loop->iteration }} photo_of_event" alt="{{$studio->studio_name}}" title="{{$studio->studio_name}}">
        </a>
      @endforeach
    @endif

    @if($studio->achievements)
      </div><h3>Достижения</h3>
      {!! $studio->achievements !!}
    @endif

    @if(sizeof($participationInEvents) > 0)
      <h3 style='margin: 15px 0px 5px; '>Участие в мероприятиях:</h3>
      @foreach ($participationInEvents as $events)
      <article>
        <a href="{{URL::to('/')}}/events/{{ $events->id }}">
          {!! $events->photoPreview() !!}
          <p class="news-title">{{ $events->title }}</p>
          <p>{{ $events->shortDescription() }}</p>
        </a>
      </article>
      @endforeach

      {{ $participationInEvents->fragment('content')->links() }}
    @endif

    <div class="clear"></div>
  </div>

@endsection
