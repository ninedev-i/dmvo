@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
   <script src="//vk.com/js/api/openapi.js?121"></script>
   <script>VK.Widgets.Group("vk_groups", {mode: 3, width: "200", height: "400", color1: "FFFFFF", color2: "2B587A", color3: "5B7FA6", no_cover: 1}, 144899977);</script>
   <meta name="_token" content="{{csrf_token()}}">
@endsection

@section('title', $page->title)

@section('content')
   {!! $adminlink !!}
   <div class="bytheway">
      <div class="info">
         <b>Режим работы:</b><br>С 10:00 до 19:00<br>
         <!--<b>Руководитель:</b><br>  <a href="about/people/82"><img width="100%" src="https://доммолодежи.рф/public/img/users/aa.levshin.jpg">  Левшин Андрей Александрович</a><br>
         <b>Телефон:</b>+7 (981) 983-04-10<br>-->
         @if (!$isWideScreen )
           <a href="https://vk.com/volcenterdmvo" target="_blank">Группа вконтакте</a>
         @endif
      </div>
   </div>
   {!! $page->content !!}

   <div class='photo_news'>
      <a href="{{ URL::to('/') }}/public/img/volunteer_1.jpg" data-fancybox="gallery"><img src="{{ URL::to('/') }}/public/img/volunteer_1.jpg" class="photo1 photo_of_event"></a>
      <a href="{{ URL::to('/') }}/public/img/volunteer_2.jpg" data-fancybox="gallery"><img src="{{ URL::to('/') }}/public/img/volunteer_2.jpg" class="photo1 photo_of_event"></a>
      <a href="{{ URL::to('/') }}/public/img/volunteer_3.jpg" data-fancybox="gallery"><img src="{{ URL::to('/') }}/public/img/volunteer_3.jpg" class="photo1 photo_of_event"></a>
      <a href="{{ URL::to('/') }}/public/img/volunteer_4.jpg" data-fancybox="gallery"><img src="{{ URL::to('/') }}/public/img/volunteer_4.jpg" class="photo1 photo_of_event"></a>
   </div>
   <div class='button' data-fancybox data-src="#hidden-content">Напиши нам!</div>

   <div style="display: none;" id="hidden-content">
      <h2 class="h2">Оставить заявку</h2>
      {!! Form::open(['id' => 'mailForm', 'class' => 'searchform']) !!}
         {!! Form::label('name', 'Ваше имя:') !!}
         {!! Form::text('name', null, ['style' => 'width: 362px;', 'required' => 'required']) !!}

         {!! Form::label('email', 'Ваш E-mail:') !!}
         {!! Form::email('email', null, ['style' => 'width: 362px;', 'required' => 'required']) !!}

         {!! Form::label('phone', 'Ваш телефон:') !!}
         {!! Form::text('phone', null, ['style' => 'width: 362px;', 'required' => 'required']) !!}

         {!! Form::label('textmessage', 'Обращение:') !!}
         {!! Form::textarea('textmessage', null, ['style' => 'width: 362px; height: 130px;', 'required' => 'required']) !!}

         {!! Form::button('Отправить', ['style' => 'display: inline-block; margin-right: 0px;', 'class' => 'sendmail']) !!}
      {!! Form::close() !!}
      <div class="isSend" style="display: none; font-weight: bold; color: #468966; font-size: 20px;">Ваше сообщение отправлено!</div>
      <div class="errorMsg" style="display: none; font-weight: bold; color: red;">Заполните обязательные поля</div>
   </div>

   <script>
   $('.sendmail').on('click', function(e){
       e.preventDefault();
       $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') } });

       if ($('#name').val() != '' && $('#email').val() != '' && $('#textmessage').val() != '') {
          $.ajax({
              type: 'post',
              url: '{{URL::to('/')}}/volunteer',
              data: {'name': $('#name').val(), 'email': $('#email').val(), 'phone': $('#phone').val(), 'textmessage': $('#textmessage').val(), '_token': $('input[name="csrf-token"]').attr('content')},
              dataType: 'json',
              complete: function(data) {
                  $('.isSend').css({'display': 'block'});
                  $('.errorMsg').css({'display': 'none'});
                  $(".searchform, .h2").fadeOut('slow');
              }
          });
       } else {
          $('.errorMsg').css({'display': 'block'});
       }
   });
   </script>

   <div id="content">
      <h2 style="margin-top: 15px;">Мероприятия волонтерского центра</h2>
      @foreach ($events as $events_item)
         <article>
            <a href="events/{{$events_item->id}}">
            {!! $events_item->photoPreview() !!}
            <p class="news-title">{{ $events_item->title }}</p>
            <p>{{ $events_item->shortDescription() }}</p>
            </a>
         </article>
      @endforeach
      {{ $events->fragment('content')->links() }}
   </div>

@endsection
