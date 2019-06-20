@extends('master')

@section('title', $media->title )

@section('content')
   {!! $adminlink !!}

   <div style="white-space: pre-line !important;">{!! $media->content !!}</div>
   <p style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #EDEFF0;">
      <b>Источник:</b> <a href="<?php if (!$isWideScreen) {echo  $media->link;}?>" style="font-style: italic;" target="_blank">{{ $media->owner }}</a>, {{ date('d.m.Y', strtotime($media->date)) }}
   </p>


@endsection
