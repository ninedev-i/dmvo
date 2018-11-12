@extends('master')

@section('title', $title)

@section('content')
   <ol>
      @foreach ($allRequests as $request)
         <li>
            {{$request->studio}}, {{$request->name}}, {{$request->phone}}
         </li>
      @endforeach
   </ol>
@endsection
