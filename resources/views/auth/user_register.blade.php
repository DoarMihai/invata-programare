@extends('layouts.master_full')
@section('title', 'User Registration - '.$defaultTitle )

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- <div class="lesson-page">Create a new account</div> -->
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
		<div class="lesson-page register-page">
			<div class="row">
				<div class="col-md-6">
					<h1>Salut! Inscrie-te si tu pe Invata-Programare!</h1>
					<form action="{{ route('user.register.post') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						{!! Honeypot::generate('my_name', 'my_time') !!}
						<div class="form-group">
							<!-- <label for="name">Nume</label> -->
							<input type="text" name="name" placeholder="Numele si Prenumele tau*" required="required" class="form-control">
						</div>
						<div class="form-group">
							<!-- <label for="email">Email</label> -->
							<input type="email" name="email" class="form-control" required="required" placeholder="Adresa ta de email">
						</div>
						<div class="form-group">
							<!-- <label for="pass">Parola</label> -->
							<input type="password" name="password" class="form-control" required="required" placeholder="Parola ta">
						</div>
						<div class="form-group">
							<!-- <label for="about">Despre Mine</label> -->
							<textarea name="about" id="" cols="30" rows="4" class="form-control" placeholder="Da-ne cateva informatii despre tine"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" value="Post" class="pull-right btn btn-primary">
						</div>
					</form>							
				</div>
				<div class="col-md-6">
					<div class="register-fb-side">
						<span class="small-info">Ai deja cont?</span>
						<a href="{{ route('user.login') }}" class="go-to-login">Intra in cont!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
@include('layouts.slider')
@endsection

@section('scripts')
	<script>
// Carousel Auto-Cycle
  $(document).ready(function() {
    $('.carousel').carousel({
      interval: 6000
    })
  });
		
	</script>
@endsection