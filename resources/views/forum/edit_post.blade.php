@extends('layouts.master')

@section('title', 'Edit Post - '.$defaultTitle )

@section('styles')
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('ckeditor/toolbarconfigurator/lib/codemirror/neo.css') }}" />
@endsection

@section('content')
		<div class="row">
			<div class="col-md-12">
				<div class="lesson-page">Edit Post</div>
					<form action="{{ route('forum.post.edit.send', [$slug, $data->id]) }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="content">Continut</label>
							<textarea name="content" id="contentEditor" cols="30" rows="5" class="form-control">{{ $data->content }}</textarea>
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