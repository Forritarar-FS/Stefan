@extends('app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">{{ $post->title }}</h2>
    </div>
    <div class="panel-body">
        {{ $post->body }}
    </div>
    <div class="panel-footer">
        
    </div>
</div>

@stop
