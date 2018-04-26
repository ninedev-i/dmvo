@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.js"></script>
   <link rel="stylesheet" href="{{URL::to('/')}}/public/js/fancyBox-3.0/dist/jquery.fancybox.css" />
@endsection

@section('title', $title)

@section('content')
   {!! $adminlink !!}
   <a href="{{URL::to('/')}}/about/team" class="smallbutton <?php if ($currentLink == 'team') {echo 'current';} ?>">О коллективе</a>
   <a href="{{URL::to('/')}}/about/administration" class="smallbutton <?php if ($currentLink == 'administration') {echo 'current';} ?>">Руководители дома молодежи</a>
   <a href="{{URL::to('/')}}/about/teachers" class="smallbutton <?php if ($currentLink == 'teachers') {echo 'current';} ?>">Руководители студий</a>
   <a href="{{URL::to('/')}}/about/specialists" class="smallbutton <?php if ($currentLink == 'specialists') {echo 'current';} ?>">Специалисты</a>
   <br />
   {!! $content !!}
   @foreach ($people as $teacher)
      <a href="{{URL::to('/')}}/about/people/{{ $teacher->id }}">
         <div class="faces">
            <div class="teachersphoto" style="background-image: url({{URL::to('/')}}/public/img/users/{{ $teacher->username }}.jpg);"></div>
            <h3>{{ $teacher->name }}</h3>
            @if ( $teacher->studio && $showStudios == true)
            <div class="teachersstudio">
               @foreach ( $teacher->studio as $studio)
                  <li>{{ $studio->studio_name }}</li>
               @endforeach
            </div>
            @endif
         </div>
      </a>
   @endforeach
   <div style="clear: both;"></div>
@endsection
