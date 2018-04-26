@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
   <script src="//vk.com/js/api/openapi.js?121"></script>
   <script>VK.Widgets.Group("vk_groups", {mode: 3, width: "300", height: "400", color1: "FFFFFF", color2: "2B587A", color3: "5B7FA6", redesign: 1}, 123029997);</script>
   <meta name="_token" content="{{csrf_token()}}">
@endsection

@section('title', $page->title)

@section('content')
   {!! $adminlink !!}
   {!! $page->content !!}

   <p>Позвонить нам: 321-24-61 или <span class="smallbutton" data-fancybox data-src="#hidden-content">Записаться online</span></p>
   <p><a href="https://vk.com/topic-123029997_37211146">Ваши отзывы, пожелания, вопросы</a></p>
   <h2>Наши специалисты</h2>
   <div class='photo_news' style='display: -webkit-flex; display: flex; justify-content: flex-start; -webkit-align-items: top; align-items: top;'>
   <!-- <a href='about/people/52' class='psy'><img src='{{URL::to('/')}}/public/img/users/an.yakkola.jpg' style='height: 110px; float: left; margin-right: 5px;'><b>Яккола Айна Николаевна</b><br />заведующая отделом<br />часы приёма:<br />вт, чт 11:00-13:00</p></a> -->
   <a href='about/people/23' class='psy'><img src='{{URL::to('/')}}/public/img/users/du.kudriavcev.jpg' style='height: 110px; float: left; margin-right: 5px;'><p><b>Кудрявцев Денис Юрьевич</b><br />психолог<br />консультации:<br />пн, ср – 17:00-20:00</p></a>
   <a href='about/people/30' class='psy'><img src='{{URL::to('/')}}/public/img/users/nf.novoselova.jpg' style='height: 110px; float: left; margin-right: 5px;'><p><b>Новосёлова Наталья Фёдоровна</b><br />психолог<br />консультации:<br />пн, ср – 17:00-20:00</p></a>
   <a href='about/people/79' class='psy'><img src='{{URL::to('/')}}/public/img/users/ae.smirnov.jpg' style='height: 110px; float: left; margin-right: 5px;'><p><b>Смирнов Анатолий Эдуардович</b><br />психолог<br />консультации:<br />пт – 16:00-19:00</p></a>
   </div>
   <h2 style='margin-bottom: 15px; margin-top: 10px;'>Направления работы</h2>
   <div style='display: -webkit-flex; display: flex; -webkit-justify-content: space-between; justify-content: space-between; -webkit-align-items: top; align-items: top;'>
   <div class='psy' style='padding: 1%; background-color: #f4f4f4;'><a href='psychological/consult' style='display: block; text-decoration: none;'><h3>Психологическое консультирование</h3><p>Оказание психологом помощи людям, которые нуждаются в ней, испытывают трудности с самоопределением, с отношениями в семье, со сверстниками, страдают от неуверенности в себе, переживаний обиды, гнева, апатии, испытывают зависимость от чего-либо. <i>Подробнее...</i></a></p></div>
   <div class='psy' style='padding: 1%; background-color: #f4f4f4;'><a href='psychological/group' style='display: block; text-decoration: none;'><h3>Групповые формы работы</h3><p>Группы – это особое направление в консультировании, которое часто оказывается эффективным средством помощи в решении личностных и межличностных проблем. Групповое взаимодействие весьма важно для самовыражения личности. <i>Подробнее...</i></a></p></div>
   <div class='psy' style='padding: 1%; background-color: #f4f4f4;'><a href='psychological/proforientation' style='display: block; text-decoration: none;'><h3>Профориентация и диагностика</h3><p>Программа профориентации создана для подростков и молодёжи. Она помогает понять, кем ты хочешь быть, какие у вас есть склонности, способности, интересы. Вы сможете ответить себе на вопрос - как сделать самостоятельный осознанный правильный выбор. <i>Подробнее...</i></a></p></div>
   <div class='psy' style='padding: 1%; background-color: #f4f4f4;'><a href='psychological/training' style='display: block; text-decoration: none;'><h3>Тренинги</h3><p>Тренинг – это активная форма работы, направленная на изменение мировоззрения, поведения, способа самовыражения посредством разыгрывания социальных ситуаций, выполнения упражнений с последующим анализом результатов. <i>Подробнее...</i></a></p></div>
   </div>

   <div style="display: none;" id="hidden-content">
      <h2 class="h2">Оставить заявку</h2>
      {!! Form::open(['id' => 'mailForm', 'class' => 'searchform']) !!}
         {!! Form::label('name', 'Ваше имя:') !!}
         {!! Form::text('name', null, ['style' => 'width: 362px;', 'required' => 'required']) !!}

         {!! Form::label('email', 'Ваш E-mail:') !!}
         {!! Form::email('email', null, ['style' => 'width: 362px;', 'required' => 'required']) !!}

         {!! Form::label('phone', 'Ваш телефон:') !!}
         {!! Form::text('phone', null, ['style' => 'width: 362px;', 'required' => 'required']) !!}

         {!! Form::label('age', 'Ваш возраст (от 14 до 30 лет):') !!}
         {!! Form::selectRange('age', 14, 30, null, ['style' => 'width: 382px; display: block;', 'required' => 'required']) !!}

         {!! Form::label('date', 'Удобная дата и время консультации:') !!}
         {!! Form::text('date', null, ['style' => 'width: 362px;', 'required' => 'required']) !!}

         {!! Form::label('choice', 'Ваш запрос:') !!}
         {!! Form::select('choice', [ '' => '', 'Психологическое консультирование' => 'Психологическое консультирование', 'Групповые формы работы' => 'Групповые формы работы', 'Профориентация и диагностика' => 'Профориентация и диагностика', 'Тренинги' => 'Тренинги' ], '', ['style' => 'width: 100%; display: block;']) !!}

         {!! Form::label('specialist', 'Выберите специалиста:') !!}
         {!! Form::select('specialist', [ '' => '', 'Кудрявцев Денис Юрьевич' => 'Кудрявцев Денис Юрьевич', 'Новосёлова Наталья Федоровна' => 'Новосёлова Наталья Федоровна', 'Смирнов Анатолий Эдуардович' => 'Смирнов Анатолий Эдуардович'], '', ['style' => 'width: 100%; display: block;']) !!}

         {!! Form::label('textmessage', 'Комментарий:') !!}
         {!! Form::textarea('textmessage', null, ['style' => 'width: 362px; height: 130px;', 'required' => 'required']) !!}

         {!! Form::button('Отправить', ['style' => 'display: inline-block; margin-right: 0px;', 'class' => 'sendmail']) !!}
      {!! Form::close() !!}
      <div class="isSend" style="display: none; font-weight: bold; color: #468966; font-size: 20px;">Ваше сообщение отправлено!</div>
      <div class="errorMsg" style="display: none; font-weight: bold; color: red;">Укажите ваше имя и e-mail</div>
   </div>

   <script>
      $('.sendmail').on('click', function(e){
         e.preventDefault();
         $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') } });

         if ($('#name').val() != '' && $('#email').val()) {
            $.ajax({
               type: 'post',
               url: '{{URL::to('/')}}/psychological',
               data: {
                  'name': $('#name').val(),
                  'email': $('#email').val(),
                  'phone': $('#phone').val(),
                  'age': $('#age').val(),
                  'date': $('#date').val(),
                  'choice': $('#choice').val(),
                  'specialist': $('#specialist').val(),
                  'textmessage': $('#textmessage').val(),
                  '_token': $('input[name="csrf-token"]').attr('content')
               },
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
      <h2 style="margin-top: 15px;">Ближайшие мероприятия отдела психологической поддержки и профориентации</h2>
      @foreach ($futureEvents as $event_item)
      <article>
         <a href="events/{{$event_item->id}}">
            {!! $event_item->photoPreview() !!}
            <p class="news-title">{{ $event_item->title }}</p>
            <p>{{ $event_item->shortDescription() }}</p>
         </a>
      </article>
      @endforeach

      <h2 style="margin-top: 15px;">Архив мероприятий</h2>
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
