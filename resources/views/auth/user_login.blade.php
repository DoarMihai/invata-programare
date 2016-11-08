@extends('layouts.master_full')
@section('title', 'User Login - '.$defaultTitle )

@section('content')

<div class="row">
	<div class="col-md-12">
		<!-- <div class="lesson-page">Create a new account</div> -->
		
			@if( isset($message) )
				<div class="alert alert-danger">
					{{ $message }}
				</div>
			@endif
		<div class="lesson-page register-page">
			<div class="row">
				<div class="col-md-6">
					<h1>Intra in cont!</h1>
					@if(Session::get('falsh_msg'))
						<div class="alert alert-success">Contul tau a fost creat, te poti autentifica!</div>
					@endif
					@if(Session::get('message'))
						<div class="alert alert-danger">{{ Session::get('message') }}</div>
					@endif

					<form action="{{ route('user.login.post') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<!-- <label for="email">Email</label> -->
							<input type="email" name="email" class="form-control" required="required" placeholder="Adresa ta de email">
						</div>
						<div class="form-group">
							<!-- <label for="pass">Parola</label> -->
							<input type="password" name="password" class="form-control" required="required" placeholder="Parola ta">
						</div>
						<div class="form-group">
							<input type="submit" value="Post" class="pull-right btn btn-primary">
						</div>
					</form>							
				</div>
				<div class="col-md-6">
					<div class="register-fb-side">
						<span class="small-info">Nu ai deja cont?</span>
						<a href="/new_account" class="go-to-login">Inscrie-te!</a>
					</div>
					<!-- <div class="register-fb-side">
						<span class="small-info">Sau conecteaza-te cu facebook</span>
						<a href="" class="btn-fb">Conecteaza-te cu facebook!</a>
					</div> -->
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