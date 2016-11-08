@extends('layouts.master')

@section('title', 'Page not found')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="post text-center">
				<h2>Aceasta pagina nu a fost gasita</h2>
				<img src="{{ asset('img/404.jpg') }}" alt="">
				<hr>
				<span class="pull-left">Poti cauta ceva aici:</span>

				<div class="row">
					<form action="">
						<div class="col-md-10">
							<input type="text" class="form-control">
						</div>
						<div class="col-md-2">
							<input type="submit" class="btn btn-default btn-block">
						</div>
					</form>	
				</div>
				<br>
				<span class="pull-left" style="text-align: left;">
					Mergi <a href="{{ url('/') }}">Acasa</a> <br>
					sau poate vrei sa mergi la <a href="{{ route('category', ['snippets']) }}">Snippet-uri</a> <br>
					sau poate vrei sa mergi la <a href="{{ route('page', ['almanach']) }}">Alamanch</a><br>
					...si daca tot nu gasesti ce doresti nu ezita sa ma <a href="{{ route('contact') }}">contactezi</a>.<br>
				</span>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
@endsection