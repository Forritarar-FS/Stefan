@extends('app')

@section('content')

<div class="container">
  <div class="panel panel-primary">
      <div class="panel-heading">
          <h2 class="panel-title">Edit: {!! $post->title !!}</h2>
      </div>
      <div class="panel-body">
          {!! Form::model($post, ['method' => 'PATCH', 'action' => ['MainController@update', $post->id]]) !!}
              @include ('forum.partials.form', ['submitButtonText' => 'Update Post'])
          {!! Form::close() !!}
      </div>
      @include ('errors.list')
  </div>
</div>
@stop
