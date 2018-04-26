@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
@endsection

@section('title', $page->title)

@section('content')
  {!! $adminlink !!}
  <a href="{{URL::to('/')}}/about/info" class="smallbutton current">О коллективе</a>
  <a href="{{URL::to('/')}}/about/administration" class="smallbutton">Руководители дома молодежи</a>
  <a href="{{URL::to('/')}}/about/teachers" class="smallbutton">Руководители студий</a>
  <a href="{{URL::to('/')}}/about/specialists" class="smallbutton">Специалисты</a>
  {!! $page->content !!}
@endsection
