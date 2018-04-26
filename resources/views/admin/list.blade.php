@extends('master')

@section('title', $title)

@section('content')

<ol>
@foreach ($list as $list_item)
  <li>
    <a href="{{ URL::current() }}/{{ $list_item->id }}">
      {{ $list_item->title }}
    </a>
  </li>
@endforeach
</ol>

@endsection
