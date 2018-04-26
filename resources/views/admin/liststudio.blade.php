@extends('master')

@section('title', $title)

@section('content')

<ol>
@foreach ($list as $list_item)
  <li>
    <a href="{{ URL::current() }}/{{ $list_item->shortname }}">
      {{ $list_item->studio_name }}
    </a>
  </li>
@endforeach
</ol>

@endsection
