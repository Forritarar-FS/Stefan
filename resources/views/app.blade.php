<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="/css/app.css" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="/ckeditor/ckeditor.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('') }}">Rng Gaming</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/">Home</a></li>
					@if (Auth::check())
					<li><a href="/post/create">Create Post</a></li>
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
					<li><a href="/auth/login">Login</a></li>
					<li><a href="/auth/register">Register</a></li>
					@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@if (Auth::user()->group == 'Admin')
							<li><a href="/admin/dashboard">Admin Dashboard</a></li>
							@endif
							<li><a href="{{ URL::to('user/' . Auth::user()->name) }}">User Dashboard</a></li>
							<li><a href="/auth/logout">Logout</a></li>
						</ul>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script>
	function submitForm(btn) {
		// disable the button
		btn.disabled = true;
		// submit the form
		btn.form.submit();
	}
	$('#editComment').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('comment') // Extract info from data-* attributes
		var url = button.data('url')
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
		modal.find('.modal-body form').attr('action', url)
	  modal.find('.modal-body textarea').val(recipient)
	})
	</script>
</body>
</html>
