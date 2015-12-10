@extends('dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="{{ URL::to('user/' . $user->name) }}">Overview <span class="sr-only">(current)</span></a></li>
                <li><a href="{{ URL::to('user/' . $user->name . '/posts') }}">Posts</a></li>
                <li><a href="{{ URL::to('user/' . $user->name . '/comments') }}">Comments</a></li>
            </ul>
            <hr>
            <ul class="nav nav-sidebar">
                <li><a href="{{ URL::to('user/' . $user->name . '/edit') }}">Edit</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @if(Session::get('message') !== null)
            <div class="alert alert-danger" role="alert">
                {{ Session::get('message') }}
            </div>
            @endif
            <h1 class="page-header" style="display:inline;">{{ $user->name }}</h1>
            @if($user->group == 'Admin')
            <h5 style="display:inline;"> <span class="label label-danger">Administrator</span></h5>
            @elseif($user->group == 'Member')
            <h5 style="display:inline;"> <span class="label label-primary">Member</span></h5>
            @endif


            <h2 class="sub-header">Profile</h2>
            <div class="row">
              <div class="col-md-3">
                <div class="well">
                  {!! Html::image('profilepics/'. $user->profilepic, 'Profile Picture', ['class' => 'img-responsive']) !!}
                </div>
              </div>
              <div class="col-md-7">
                <h3 style="text-align:center;">Information</h3>
                <h5>E-Mail: {{ $user->email }}</h5>
                <h5>Created At: {{ $user->created_at }}</h5>
                <h5>Posts: {{ $user->posts()->count() }}</h5>
                <h5>Comments: {{ $user->comments()->count() }}</h5>
                <h5>Reputation: {{ $user->votes }}</h5>
                <hr>
                <h4>Signature</h4>
                <p>{!! $user->signature !!}</p>
              </div>
            </div>


        </div>
    </div>
</div>

<!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script language="javascript" type="text/javascript">
CKEDITOR.replace('editor1');
$(".header").click(function () {

    $header = $(this);
    //getting the next element
    $content = $header.next();
    $className = $content.attr('class');
    $className = $className + "-header";
    console.log($className);
    $('.' + $className).toggleClass('glyphicon-menu-down', 'glyphicon-menu-right');
    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    $content.slideToggle(500);

});
</script>
</body>
</html>

@stop
