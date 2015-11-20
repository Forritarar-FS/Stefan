@extends('dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li><a href="{{ URL::to('user/' . $user->name) }}">Overview</a></li>
					<li class="active"><a href="{{ URL::to('user/' . $user->name . '/posts') }}">Posts <span class="sr-only">(current)</span></a></li>
					<li><a href="{{ URL::to('user/' . $user->name . '/comments') }}">Comments</a></li>
        </ul>
				<hr>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">{{ $user->name }}</h1>

        <h2 class="sub-header">Posts</h2>

        <ul class="list-group">
          @foreach ($posts as $post)
            <a href="{{ url('/post', $post->slug) }}" style="text-decoration:none;">
                <li class="list-group-item">
                  <div class="col-md-8">
                    <h2>{{ $post->title }}</h2>
                    <p>Started by {{ $post->user->name }}</p>
                  </div>
                  <div class="col-md-2 text-center">
                    <br>
                    Comments {{ $post->comments()->get()->count()}}<br>
                    Views {{ $post->views }}
                  </div>
                  <div class="col-md-2 text-right">
                    @if($post->comments()->latest('published_at')->first())
                      {{ $post->comments()->latest('published_at')->first()->published_at->format('F jS\\, Y') }}<br>
                      {{ $post->comments()->latest('published_at')->first()->published_at->toTimeString() }}<br><br>
                      By {{ $post->comments()->latest('published_at')->first()->user->name }}
                    @else
                      {{ $post->published_at->format('F jS\\, Y') }}
                      {{ $post->published_at->toTimeString() }}<br><br>
                      By {{ $post->user->name }}
                    @endif
                  </div>

                  <div class="clearfix"></div>
                </li>
            </a>
          @endforeach
        </ul>

      </div>
    </div>
  </div>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>

@stop
