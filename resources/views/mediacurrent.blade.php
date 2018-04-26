@extends('master')

@section('title', $media->title )

@section('content')
   {!! $adminlink !!}

   <div>{!! $media->content !!}</div>
   <p style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #EDEFF0;"><b>Источник:</b> <a href="{{ $media->link }}" style="font-style: italic;" target="_blank">{{ $media->owner }}</a>, {{ date('d.m.Y', strtotime($media->date)) }}</p>


@endsection
