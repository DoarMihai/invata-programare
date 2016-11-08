@extends('admin.layouts.master')

@section('page', 'Edit Article')

@section('content')
<form action="{{ route('admin.edit.article.post', [$data->id]) }}" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="col-md-8">
		<div class="admin-bg">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" class="form-control" value="{{ $data->name }}">
			</div>
			<div class="form-group">
				<label for="slug">Slug</label>
				<input type="text" name="slug" id="slug" class="form-control" value="{{ $data->slug }}">
			</div>
			<div class="form-group">
				<label for="content">Content</label>
				<textarea name="content" id="content" cols="30" rows="10">{{ $data->content }}</textarea>
			</div>
			<div class="form-group">
				<label for="meta_keywords">Meta Keywords</label>
				<input type="text" name="meta_keywords" id="meta_keywords" class="form-control" value="{{ $data->meta_keywords }}">
			</div>
			<div class="form-group">
				<label for="meta_description">Meta Description</label>
				<input type="text" name="meta_description" id="meta_description" class="form-control" value="{{ $data->meta_description }}">
			</div>

		</div>
	</div>
	<div class="col-md-4">
		<div class="admin-bg">
			<div class="form-group">
				<input type="text" name="datepicker" class="form-control" value="{{ $data->created_on }}" readonly>
			</div>
			<div class="form-group">
				<input type="submit" value="Update" class="btn btn-primary pull-right">
			</div>
			<div class="clearfix"></div>
		</div>
		<br>
		<div class="admin-bg">
			<label for="category">Category</label> <br>
			@if($categories->count() > 0)
				<ul class="admin-categories">
				@foreach($categories as $category)
					<li>
						@if( $category->parent == 0 )
						<input type="checkbox" value="{{ $category->id }}" name="category[]" id="cat-{{$category->id}}" {{ $selectedCat->category_id == $category->id ? 'checked' : '' }}><label for="cat-{{$category->id}}">{{ $category->name }}</label>
						@endif
							@if($category->childs->count())
								<ul class="childs">
									@foreach($category->childs as $child)
										<li><input type="checkbox" value="{{ $child->id }}" name="category[]" id="cat-{{$child->id}}" {{ $selectedCat->category_id == $child->id ? 'checked' : '' }}><label for="cat-{{$child->id}}">{{ $child->name }}</label></li>
									@endforeach
								</ul>
							@endif
					</li>
				@endforeach
				</ul>
			@else
				<em>No categories</em>	
			@endif
		</div>
		<br>
		<div class="admin-bg">
			<label for="thumbnail">Thumbnail</label>
			@if($data->picture)
				<div class="edit-pic">
					<img src="{{ asset('uploads/thumbnails/'.$data->picture) }}" alt="" class="img img-responsive">
					<a href="" class="delete-img">&times;</a>
				</div>
			@endif
			<input type="file" name="thumbnail" id="thumbnail">
		</div>

	</div>
</form>
@endsection
@section('scripts')
	<script src="{{ asset('admin-folder/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('admin-folder/js/ckeditor/ckeditor.js') }}"></script>
	<script>
		CKEDITOR.replace( 'content' );
		$('.datepicker').datepicker()
	</script>
@endsection