@extends('app')

@section('content')


<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Create a post</h2>
    </div>
    <div class="panel-body">
        {!! Form::open(array('url' => 'post')) !!}
            @include ('forum.partials.form', ['submitButtonText' => 'Create Post'])
        {!! Form::close() !!}
    </div>
    @include ('errors.list')
</div>


@stop
