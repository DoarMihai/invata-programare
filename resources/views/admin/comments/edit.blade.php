@extends('admin.layouts.master')

@section('page', 'Edit Comment')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			<form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="nume">Postat de</label>
					<input type="text" name="nume" id="nume" value="{{ $comment->name }}" class="form-control">
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" value="{{ $comment->email }}" class="form-control">
				</div>
				<div class="form-group">
					<label for="website">WebSite</label>
					<input type="text" name="website" id="website" value="{{ $comment->website }}" class="form-control">
				</div>	
				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="content" id="content" cols="30" rows="4" class="form-control">{{ $comment->content }}</textarea>
				</div>
				<div class="form-group pull-right text-right">
					<a href="{{ route('admin.comments') }}" class="btn btn-default">Cancel</a>
					<input type="submit" value="Edit" class="btn btn-primary">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
@endsection