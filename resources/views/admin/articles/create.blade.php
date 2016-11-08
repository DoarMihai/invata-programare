@extends('admin.layouts.master')

@section('page', 'New Article')

@section('content')
<form action="{{ route('admin.create.article.post') }}" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="col-md-8">
		<div class="admin-bg">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" class="form-control">
			</div>
			<div class="form-group">
				<label for="slug">Slug</label>
				<input type="text" name="slug" id="slug" class="form-control">
			</div>
			<div class="form-group">
				<label for="content">Content</label>
				<textarea name="content" id="content" cols="30" rows="10"></textarea>
			</div>
			<div class="form-group">
				<label for="meta_keywords">Meta Keywords</label>
				<input type="text" name="meta_keywords" id="meta_keywords" class="form-control">
			</div>
			<div class="form-group">
				<label for="meta_description">Meta Description</label>
				<input type="text" name="meta_description" id="meta_description" class="form-control">
			</div>

		</div>
	</div>
	<div class="col-md-4">
		<div class="admin-bg">
			<div class="form-group">
				<label for="save"><input type="radio" id="save" name="status" value="0"> Save Draft</label> <br>
				<label for="publish"><input type="radio" id="publish" name="status" value="1"> Publish</label>
			</div>
			<div class="form-group">
				<input type="text" name="datepicker" class="form-control datepicker">
			</div>
			<div class="form-group">
				<input type="submit" value="Post" class="btn btn-primary pull-right">
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
						<input type="checkbox" value="{{ $category->id }}" name="category[]" id="cat-{{$category->id}}"><label for="cat-{{$category->id}}">{{ $category->name }}</label>
						@endif
							@if($category->childs->count())
								<ul class="childs">
									@foreach($category->childs as $child)
										<li><input type="checkbox" value="{{ $child->id }}" name="category[]" id="cat-{{$child->id}}"><label for="cat-{{$child->id}}">{{ $child->name }}</label></li>
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
			<input type="file" name="thumbnail" id="thumbnail">
		</div>
		<br>
		<div class="admin-bg">
			<label for="lesson">Lesson</label>
			<select name="lesson" id="lesson" class="form-control">
				<option value="">--Select--</option>
				@foreach($lessons as $lesson)
					<option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
				@endforeach
			</select>
			<label for="">Section</label>
			<select name="section" id="section" class="form-control">
				<option value="1">Incepatori</option>
				<option value="2">Intermediari</option>
				<option value="3">Avansati</option>
			</select>
			<label for="order">Order</label>
			<input type="text" name="order" id="order" class="form-control">
		</div>

	</div>
</form>
@endsection
@section('scripts')
	<script src="{{ asset('admin-folder/js/bootstrap-datepicker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin-folder/js/ckeditor/plugins/syntaxhighlight/plugin.js') }}" charset="utf-8"></script>
	<script src="{{ asset('admin-folder/js/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('js/elfinder/elfinder.min.js') }}"></script>
	<script>
		CKEDITOR.replace( 'content',{
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserImageUploadUrl : "{{ route('admin.upload.img',['_token' => csrf_token() ]) }}"
        });

		$('.datepicker').datepicker()
		$('#title').on('change, keyup', function(){
			$('#slug').val( convertToSlug($('#title').val()) );
		})

	function convertToSlug(Text)
	{
	    return Text
	        .toLowerCase()
	        .replace(/ /g,'-')
	        .replace(/[^\w-]+/g,'')
	        ;
	}				
	</script>
@endsection