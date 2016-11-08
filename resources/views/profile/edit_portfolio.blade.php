@extends('layouts.master')

@section('title', Auth::user()->name."'s item - ".$defaultTitle )

@section('content')
<div class="profile-page">
	<div class="row">

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

	<form action="{{ route('post.profile.portfolio.item', $data->id) }}" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		{!! Honeypot::generate('my_name', 'my_time') !!}
		<div class="col-md-12">
			<div class="lesson-page">
				<div class="form-group">
					<label for="">Nume</label>
					<input type="text" name="name" value="{{ $data->name }}" class="form-control">
				</div>
 				<div class="form-group">
					<label for="">Descriere</label>
					<textarea name="description" id="" cols="30" rows="4" class="form-control">{{ $data->description }}</textarea>
				</div>
				<div class="form-group">
					<label for="">Tehnologii folosite</label>
					<input type="text" name="skills" value="{{ $data->skills }}" class="form-control">
				</div>
				<?php //var_dump( $data->pic ); ?>
				@if($data->pic)
					<div class="row">
						<div class="col-md-2">
							<img src="{{ asset('uploads/portfolios/'.$data->user_id.'/'.$data->pic) }}" alt="" class="img img-responsive">
						</div>
						<div class="col-md-10">
							<div class="form-group">
								<label for="">Poza</label>
								<input type="file" name="pic">
							</div>							
						</div>
					</div>
				@else
					<div class="form-group">
						<label for="">Poza</label>
						<input type="file" name="pic">
					</div>
				@endif
				<div class="form-group">
					<label for="">Link</label>
					<input type="text" name="link" value="{{ $data->link }}" class="form-control">
				</div>
				<span class="pull-right">
					<input type="submit" class="btn btn-primary">
				</span>
				<div class="clearfix"></div>
			</div>
		</div>
	</form>
	</div>
</div>
<br>
@endsection
