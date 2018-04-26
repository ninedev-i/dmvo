@extends('master')

@section('title', 'Страница не найдена')

@section('content')
<div style="float: right; width: 500px;">
   <img src="{{URL::to('/')}}/public/img/img_404.png" style="float: right;">
   <p style="font-size: 45px; font-weight: bold; margin-top: 240px;">404 ошибка</p>
   <p><b>Страница либо удалена, либо вовсе никогда не существовала.</b></p>
</div>

@endsection
