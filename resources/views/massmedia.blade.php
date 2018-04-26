@extends('master')

@section('title', $title)

@section('content')

{!! $adminlink !!}

@foreach ($list as $list_item)
   <article>
     <a href="{{ URL::current() }}/{{ $list_item->id }}" rel="nofollow">
       <p class="news-title">{{$list_item->owner }} «{{ $list_item->title }}»</p>
       {{ $list_item->shortDescription() }}
       <p style="text-align: right;">{{ date('d.m.Y', strtotime($list_item->date)) }}</p>
     </a>
   </article>
@endforeach

@endsection
