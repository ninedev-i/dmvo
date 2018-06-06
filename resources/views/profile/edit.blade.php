@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/wyseditor.js"></script>
@endsection

@section('title', 'Редактировать информацию')
@section('content')

{!! Form::open(['url' => URL::current(), 'enctype' => 'multipart/form-data' ]) !!}
<table class="admintable">
   <tr><td>{!! Form::label('name', 'ФИО') !!}</td><td>  {!! Form::text('name', $user->name) !!}</td></tr>
   <tr><td>О себе</td><td><div class="mycontent1" style="padding: 1%; border: 1px solid #006699; width: 98%;" contenteditable></div>{!! Form::textarea('bio', $user->bio, ['class' => 'hiddenarea1']) !!}</td></tr>
   <tr>
      <td>Загрузить фотографию</td>
      <td><input name="uploadFile" type="file" /></td>
   </tr>
</table>
{!! Form::submit('Сохранить изменения') !!}
{!! Form::close() !!}

<script>
   new ContentEditor(1, true);
</script>
@endsection
