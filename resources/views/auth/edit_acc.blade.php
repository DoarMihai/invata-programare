@extends('layouts.master')
@section('title', 'Edit Account - '.$defaultTitle )

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
					<form action="{{ route('user.edit.post') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						{!! Honeypot::generate('my_name', 'my_time') !!}						
						<div class="form-group">
							<label for="">Nume</label>
							<input type="text" name="name" class="form-control" value="{{ $data->name }}">
						</div>
						<div class="form-group">
							<label for="">Despre Mine</label>
							<textarea name="about" id="" cols="30" rows="4">{{ $data->about }}</textarea>
						</div>
						<div class="form-group">
							<label for="">Email</label>
							<input type="email" name="email" class="form-control" value="{{ $data->email }}">
						</div>
						<div class="form-group">
							<label for="">Avatar</label>
							<input type="file" name="avatar">
						</div>
						<div class="form-group">
							<label for="">Educatie</label>
							<div class="row">
								<div class="col-md-8">
									<input type="text" name="education_name" class="form-control" placeholder="Nume" value="{{ isset($data->education[0]) && $data->education[0]->name ? $data->education[0]->name : '' }}">
								</div>
								<div class="col-md-2">
									<input type="text" name="education_start" class="form-control" placeholder="Inceput in" value="{{ isset($data->education[0]) && $data->education[0]->started ? $data->education[0]->started : '' }}">
								</div>
								<div class="col-md-2">
									<input type="text" name="education_start" class="form-control" placeholder="Terminat in" value="{{ isset($data->education[0]) && $data->education[0]->ended ? $data->education[0]->ended : '' }}">
								</div>

							</div>
						</div>

						<div class="form-group">
							<input type="submit" class="pull-right btn btn-primary" value="Edit!">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix"></div>
@endsection