@extends('layouts.master')
@section('title', 'Add portfolio item - '.$defaultTitle )

@section('content')

<div class="row">
	<div class="col-md-12 col-xs-12">
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
				<div class="col-md-12">
					<form action="{{ route('user.portfolio.add.post') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						{!! Honeypot::generate('my_name', 'my_time') !!}						
						<div class="form-group">
							<label for="name">Denumire proiect</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="description">Descriere proiect</label>
							<textarea name="description" id="description" cols="30" rows="4"></textarea>
						</div>
						<div class="form-group">
							<label for="skills">Tehnologii folosite</label>
							<input type="text" name="skills" class='form-control'>
						</div>		
						<div class="form-group">
							<label for="link">Link</label>
							<input type="text" name="link" class='form-control'>
						</div>		
						<div class="form-group">
							<label for="pic">Imagine</label>
							<input type="file" name="pic">
						</div>
						<div class="form-group">
							<input type="submit" class="pull-right btn btn-primary" value="Add item!">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
@endsection