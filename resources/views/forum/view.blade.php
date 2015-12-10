@extends('app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <a href="{{ URL::to('user/' . $post->user->name) }}" style="text-decoration: none;">
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
      </a>
    </div>
    <div class="col-md-9">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title">{{ $post->title }}
            @if(Auth::check() and Auth::user()->group == 'Admin' or Auth::check() and Auth::user()->name == $post->user->name)
            <div class="pull-right">
              <a href="{{ URL::to('post/' . $post->slug . '/edit') }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color:#FFF;"></span></a>
              <a href="{{ URL::to('post/' . $post->slug . '/delete') }}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="margin-left:10px;color:#FFF;"></span></a>
            </div>
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
                <a href="{{ URL::to('post/' . $post->slug . '/upvote') }}">
                  <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" style="margin:0px;">
                </a>
                <h3 style="margin:0px;">
                  {{ $post->votes }}
                </h3>
                <a href="{{ URL::to('post/' . $post->slug . '/downvote') }}">
                  <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" style="margin:0px;">
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer">
          {!! $post->user->signature !!}
        </div>
      </div>
    </div>
  </div>

  <hr/>

  @if($comments)
  <div class="well">
    @foreach($comments as $comment)
      <div class="col-md-2">
        <a href="{{ URL::to('user/' . $comment->user->name) }}" style="text-decoration: none;">
          <div class="panel panel-purple">
            <div class="panel-heading">
              <h2 class="panel-title" style="text-align: center;">{{ $comment->user->name }}</h2>
            </div>
            <div class="panel-body">
              {!! Html::image('profilepics/'. $comment->user->profilepic, 'Profile Picture', ['class' => 'img-responsive']) !!}

            </div>
            <div class="panel-footer">
              <span class="pull-right">{{ $comment->published_at->diffForHumans() }}</span>
              <div class="clearfix"></div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-10">
        <div class="panel panel-purple">
          <div class="panel-heading">
            <h2 class="panel-title">
              {{ $comment->user->name }}
              @if(Auth::check() and Auth::user()->group == 'Admin' or Auth::check() and Auth::user()->name == $comment->user->name)
              <div class="pull-right">
                <a data-target="#editComment" data-toggle="modal" data-comment="{{ $comment->body }}" data-url="{{ $post->slug . '/edit/' . $comment->id }}" href="#editComment"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color:#FFF;"></span></a>
                <a href="{{ URL::to('post/' . $post->slug . '/delete/' . $comment->id) }}"><span class="glyphicon glyphicon-remove" aria-hidden="true" style="margin-left:10px;color:#FFF;"></span></a>
              </div>
              @endif
            </h2>
          </div>
          <div class="panel-body">
            <div class="col-md-11">
              {{ $comment->body }}
            </div>
            <div class="col-md-1">
              <div class="pull-right">
                <a href="{{ URL::to('/post/'. $post->slug . '/upvote/' . $comment->id) }}">
                  <span class="glyphicon glyphicon-chevron-up" aria-hidden="true" style="margin:0px;">
                </a>
                <h3 style="margin:0px;">
                  {{ $comment->votes }}
                </h3>
                <a href="{{ URL::to('/post/'. $post->slug . '/downvote/' . $comment->id) }}">
                  <span class="glyphicon glyphicon-chevron-down" aria-hidden="true" style="margin:0px;">
                </a>
              </div>
            </div>
          </div>
          <div class="panel-footer">
            <span class="pull-right">
              {{ $comment->published_at->diffForHumans() }}
            </span>
            <div class="clearfix">
            </div>
          </div>
        </div>
      </div>

    <div class="clearfix">
    </div>
    @endforeach
  </div>
  @endif

  <hr/>

  @if(Auth::check())
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h2 class="panel-title">
        Create Comment
      </h2>
    </div>
    <div class="panel-body">
      {!! Form::open() !!}
      <div class="form-group">
        {!! Form::label('body', 'Comment:') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::submit('Comment', ['class' => 'btn btn-primary form-control', 'id' => 'submitButton', 'onclick' => 'submitForm(this)']) !!}
      </div>
      {!! Form::close() !!}
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#advEditor" style="display: block; width: 100%;">
        Advanced Editor
      </button>
    </div>
  </div>

  <div class="modal fade bs-example-modal-lg" id="advEditor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">
            Advanced Editor
          </h4>
        </div>
        <div class="modal-body">
          {!! Form::open() !!}
          <div class="form-group">
            {!! Form::label('body', 'Comment:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'editor1']) !!}
          </div>
          <div class="modal-footer">
            <div class="form-group">
              {!! Form::submit('Comment', ['class' => 'btn btn-primary form-control', 'id' => 'submitButton']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <script>
  CKEDITOR.replace('editor1');
  </script>

  <div class="modal fade bs-example-modal-lg" id="editComment" tabindex="-1" role="dialog" aria-labelledby="editComm">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="editComm">
            Edit Comment
          </h4>
        </div>
        <div class="modal-body">
          {!! Form::open() !!}
          <div class="form-group">
            {!! Form::label('body', 'Comment:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'editor1']) !!}
          </div>
          <div class="modal-footer">
            <div class="form-group">
              {!! Form::submit('Edit', ['class' => 'btn btn-primary form-control', 'id' => 'submitButton']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <script>
  CKEDITOR.replace('editor1');
  </script>
  @endif
</div>

@stop
