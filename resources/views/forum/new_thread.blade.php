@extends('layouts.master')

@section('title', 'New Thread - '.$defaultTitle )

@section('content')
		<div class="row">
			<div class="col-md-12">
				<div class="lesson-page">Create new thread</div>
					<form action="{{ route('forum.new.thread.post', $cat) }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="name">Titlu</label>
							<input type="text" name="name" class="form-control" placeholder="Titlu Topic">
						</div>
						<div class="form-group">
							<label for="icon">Icon</label>
							<input type="file" name="icon">
						</div>
						<div class="form-group">
							<label for="description">Descriere</label>
							<textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" value="Post" class="pull-right btn btn-primary">
						</div>
					</form>
				</div>
		</div>
@endsection