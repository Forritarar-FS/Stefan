@extends('dashboard')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="{{ URL::to('user/' . $user->name) }}">Overview</a></li>
                <li><a href="{{ URL::to('user/' . $user->name . '/posts') }}">Posts</a></li>
                <li class="active"><a href="{{ URL::to('user/' . $user->name . '/comments') }}">Comments <span class="sr-only">(current)</span></a></li>
            </ul>
            <hr>
            <ul class="nav nav-sidebar">
                <li><a href="{{ URL::to('user/' . $user->name . '/edit') }}">Edit</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">{{ $user->name }}</h1>

            <h2 class="sub-header">Comments</h2>

            <ul class="list-group">
                @foreach ($comments as $comment)
                <a href="{{ url('/post', $comment->posts->slug) }}" style="text-decoration:none;">
                    <li class="list-group-item">
                        <div class="col-md-10">
                            <h2>{{ $comment->posts->title }}</h2>
                            <p>{{ $comment->body }}</p>
                        </div>
                        <div class="col-md-2 text-right">
                            {{ $comment->published_at->format('F jS\\, Y') }}<br>
                            {{ $comment->published_at->toTimeString() }}<br><br>
                            By {{ $comment->user->name }}
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
