@extends('layouts.master')

@section('title', 'New Topic - '.$defaultTitle )

@section('styles')
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('ckeditor/toolbarconfigurator/lib/codemirror/neo.css') }}" />
@endsection

@section('content')
		<div class="row">
			<div class="col-md-12">
				<div class="lesson-page">Create new topic</div>
					<form action="{{ route('forum.new.topic.post', $thread) }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="name">Titlu</label>
							<input type="text" name="name" class="form-control" placeholder="Titlu Topic">
						</div>
						<div class="form-group">
							<label for="description">Descriere</label>
							<textarea name="description" id="" cols="30" rows="2" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="content">Continut</label>
							<textarea name="content" id="contentEditor" cols="30" rows="5" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" value="Post" class="pull-right btn btn-primary">
						</div>
					</form>
				</div>
		</div>
@endsection

@section('scripts')
	<script>
		CKEDITOR.replace( 'contentEditor' );
	</script>
@endsection