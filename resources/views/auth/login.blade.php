<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
		<title>Invata-Programare : Tutoriale gratuite de PHP, HTML5, CSS3, jQuery si multe altele - Tutoriale gratuite de PHP, HTML5, CSS, JavaScript, jQuery, Java, C++, Python si mutle aletele</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />	
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" />
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="login-page">

<div class="text-center" style="padding:50px 0">
	<div class="logo"><img src="{{ asset('img/logo-xs.png') }}" alt=""></div>

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

	<!-- Main Form -->
	<div class="login-form-1">
		<form id="login-form" class="text-left" action="{{ url('account/login') }}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			{!! Honeypot::generate('my_name', 'my_time') !!}
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="email" class="sr-only">Username</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="username">
					</div>
					<div class="form-group">
						<label for="password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="password">
					</div>
					<div class="form-group login-group-checkbox">
						<input type="checkbox" id="lg_remember" name="lg_remember">
						<label for="lg_remember">remember</label>
					</div>
				</div>
				<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>forgot your password? <a href="#">click here</a></p>
				<p>new user? <a href="{{ url('account/register') }}">create new account</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>

</body>
</html>