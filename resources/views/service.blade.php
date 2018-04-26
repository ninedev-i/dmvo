@extends('master')

@section('title', $page->title)

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
   <meta name="_token" content="{{csrf_token()}}">
@endsection

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/masonry.js"></script>
   <script>$(document).ready(function() {$(".services").masonry({itemSelector: "a", singleMode: false, isResizable: true, isAnimated: true, animationOptions: {queue: false, duration: 500}});});</script>
@endsection

@section('content')
  {!! $adminlink !!}
  {!! $page->content !!}

  <div style="display: none;" id="hidden-content">
     <h2 class="h2">Оставить заявку на посещение</h2>
     {!! Form::open(['id' => 'mailForm', 'class' => 'searchform']) !!}
        {!! Form::label('organisation', 'Название учреждения:') !!}
        {!! Form::text('organisation', null, ['style' => 'width: 450px;', 'required' => 'required']) !!}

        {!! Form::label('fio', 'Ф.И.О. сопровождающего:') !!}
        {!! Form::text('fio', null, ['style' => 'width: 450px;', 'required' => 'required']) !!}

        {!! Form::label('contact', 'Контактный телефон, e-mail:') !!}
        {!! Form::text('contact', null, ['style' => 'width: 450px;', 'required' => 'required']) !!}

        {!! Form::label('textmessage', 'Дата, Ф.И.О. учащихся, возраст, cостоят ли на учете в ОДН::') !!}
        {!! Form::textarea('textmessage', null, ['style' => 'width: 450px; height: 130px;', 'required' => 'required']) !!}

        {!! Form::button('Отправить заявку', ['style' => 'display: inline-block; margin-right: 0px;', 'class' => 'sendmail']) !!}
     {!! Form::close() !!}
     <div class="isSend" style="display: none; font-weight: bold; color: #468966; font-size: 20px;">Ваше сообщение отправлено!</div>
     <div class="errorMsg" style="display: none; font-weight: bold; color: red;">Заполните обязательные поля</div>
  </div>

  <script>
  $('.sendmail').on('click', function(e){
      e.preventDefault();
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content') } });

      if ($('#contact').val() != '' && $('#textmessage').val() != '') {
         $.ajax({
             type: 'post',
             url: '{{URL::to('/')}}/service/transeforce',
             data: {'organisation': $('#organisation').val(), 'fio': $('#fio').val(), 'contact': $('#contact').val(), 'textmessage': $('#textmessage').val(), '_token': $('input[name="csrf-token"]').attr('content')},
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
@endsection
