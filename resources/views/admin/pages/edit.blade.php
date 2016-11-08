@extends('admin.layouts.master')

@section('page', 'Pages')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			<form action="{{ route('admin.pages.edit.post', $pageData->id) }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="">Name</label>
					<input type="text" name="name" class="form-control" value="{{ $pageData->name }}">
				</div>
				<div class="form-group">
					<label for="">Slug</label>
					<input type="text" name="slug" class="form-control" value="{{ $pageData->slug }}">
				</div>
				<div class="form-group">
					<label for="">Content</label>
					<textarea name="content" id="" cols="30" rows="10" class="form-control">{!! $pageData->content !!}</textarea>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right" value="Edit">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		// CKEDITOR.replace( 'content');
	</script>
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