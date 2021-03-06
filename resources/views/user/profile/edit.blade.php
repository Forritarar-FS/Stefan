@extends('dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="{{ URL::to('user/' . $user->name) }}">Overview</a></li>
                <li><a href="{{ URL::to('user/' . $user->name . '/posts') }}">Posts</a></li>
                <li><a href="{{ URL::to('user/' . $user->name . '/comments') }}">Comments</a></li>
            </ul>
            <hr>
            <ul class="nav nav-sidebar">
                <li class="active"><a href="/">Edit <span class="sr-only">(current)</span></a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Dashboard</h1>

            <h2 class="sub-header">Edit</h2>

            <div class="header">
                <h4 style="display:inline">Profile Picture</h4><span class="profile-pic-header glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            </div>
            <div class="profile-pic" style="display:none;">
                {!! Form::open(['url' => 'user/dashboard/edit/profile-pic', 'files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('image', 'Image:') !!}
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control" onclick="submitForm(this)">
                        <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
            <br>
            <div class="header">
                <h4 style="display:inline">Signature</h4><span class="signature-header glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            </div>
            <div class="signature" style="display:none;">
                {!! Form::model($user, ['url' => 'user/dashboard/edit/signature']) !!}
                <div class="form-group">
                    {!! Form::label('signature', 'Signature:') !!}
                    {!! Form::textarea('signature', null, ['class' => 'form-control', 'id' => 'editor1']) !!}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control" onclick="submitForm(this)">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Sign
                    </button>
                </div>
                {!! Form::close() !!}
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
<script>
function submitForm(btn) {
    // disable the button
    btn.disabled = true;
    // submit the form
    btn.form.submit();
}
</script>
</body>
</html>
@stop
