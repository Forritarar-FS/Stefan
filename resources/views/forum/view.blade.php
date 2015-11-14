@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2 class="panel-title">{{ $post->user->name }} <span class="pull-right">{{ $post->user->group }}</span></h2>
                </div>
                <div class="panel-body">
                    {!! Html::image('profilepics/'. $post->user->profilepic, 'Profile Picture', ['class' => 'img-responsive']) !!}

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
                    <h2 class="panel-title">{{ $post->title }}
                    @if(Auth::check() and Auth::user()->group == 'Admin')
                          <a href="{{ url('/post/delete', $post->slug) }}"><span class="pull-right glyphicon glyphicon-remove" aria-hidden="true" style="margin:0px;padding:0px;"></a>
                    @endif
                    </h2>
                </div>
                <div class="panel-body" style="word-wrap: break-word;">
                  <div class="row">
                    <div class="col-md-11">
                      {!! $post->body !!}
                    </div>
                    <div class="col-md-1">
                      <div class="pull-right">
                        <a href="{{ url('/post/upvote', $post->slug) }}"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true" style="margin:0px;"></a>
                          <h3 style="margin:0px;">{{ $postVote }}</h3>
                        <a href="{{ url('/post/downvote', $post->slug) }}"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true" style="margin:0px;"></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel-footer">
                    {{ $post->user->signature }}
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
                    <span class="pull-right">{{ $commVote }}</span>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    {{ $comment->body }}
                </div>
                <div class="panel-footer">
                    <a href="{{ URL::to('/post/'. $post->slug . '/upvote/' . $comment->id) }}">Upvote</a><a href="{{ URL::to('/post/'. $post->slug . '/downvote/' . $comment->id) }}">Downvote</a>
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
