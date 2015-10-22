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
        <span class="pull-right">Posted by {{ $post->user->name }} {{ $post->published_at->diffForHumans() }}</span>
        <div class="clearfix"></div>
    </div>
</div>

<hr/>

<div class="well">
    @foreach($comments as $comment)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="panel-title">{{ $comment->user->name }}</h2>
            </div>
            <div class="panel-body">
                {{ $comment->body }}
            </div>
            <div class="panel-footer">
                <span class="pull-right">{{ $comment->published_at->diffForHumans() }}</span>
                <div class="clearfix"></div>
            </div>
        </div>
    @endforeach
</div>

<hr/>

@if(Auth::check())
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="panel-title">Create Comment</h2>
        </div>
        <div class="panel-body">
            {!! Form::open() !!}
                <div class="form-group">
                    {!! Form::label('body', 'Comment:') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Comment', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endif

@stop
