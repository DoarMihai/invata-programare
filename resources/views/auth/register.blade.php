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

<!-- REGISTRATION FORM -->
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
					
<div class="text-center" style="padding:50px 0">
	<div class="logo">register</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form id="register-form" class="text-left" action="{{ url('account/register') }}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			{!! Honeypot::generate('my_name', 'my_time') !!}
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="reg_username" class="sr-only">Username</label>
						<input type="text" class="form-control" id="reg_username" name="name" placeholder="username">
					</div>
					<div class="form-group">
						<label for="reg_password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="reg_password" name="password" placeholder="password">
					</div>
					<div class="form-group">
						<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
						<input type="password" class="form-control" id="reg_password_confirm" name="password_confirmation" placeholder="confirm password">
					</div>
					
					<div class="form-group">
						<label for="reg_email" class="sr-only">Email</label>
						<input type="text" class="form-control" id="reg_email" name="email" placeholder="email">
					</div>
								
				</div>
				<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>already have an account? <a href="{{ url('account/login') }}">login here</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>

</body>
</html>