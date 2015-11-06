@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">{{ $post->user->name }}</h2>
                </div>
                <div class="panel-body">
                    {!! Html::image('images/default.jpg', 'Profile Picture', ['class' => 'img-responsive']) !!}
                </div>
                <div class="panel-footer">
                    <span class="pull-right">{{ $post->published_at->diffForHumans() }}</span>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">{{ $post->title }}</h2>
                </div>
                <div class="panel-body" style="word-wrap: break-word;">
                    {{ $post->body }}
                </div>
                <div class="panel-footer">
                    This is a Sample Signature.
                </div>
            </div>
        </div>
    </div>

  <hr/>

  @if($comments)
    <div class="well">
        @foreach($comments as $comment)
            <div class="panel panel-purple">
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
  @endif

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
</div>

@stop
