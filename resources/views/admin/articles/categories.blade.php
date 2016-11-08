@extends('admin.layouts.master')

@section('page', 'Categories')

@section('content')
	<div class="col-md-6">
		<div class="admin-bg">
			<form action="{{ route('admin.categories.post') }}" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="nume">Nume</label>
					<input type="text" name="name" id="nume" placeholder="Numele categoriei" class="form-control">
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" name="slug" id="slug" placeholder="Urlul categoriei" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Icon</label>
					<input type="file" name="icon">
				</div>
				<div class="form-group">
					<label for="">Description</label>
					<textarea name="description" id="" cols="30" rows="4" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="">Parent</label>
					<select name="parent" id="" class="form-control">
						<option value="0">-- Select --</option>
						@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach			
					</select>
				</div>
				<div class="form-group">
					<label for="icon">Icon</label>
					<input type="file" name="icon">
				</div>
				<div class="form-group">
					<input type="submit" value="Create" class="btn btn-primary pull-right">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="admin-bg">
			<table class="table table-responsive table-stripped">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					
			@foreach($categories as $category)
				<tr>
					<td>{{ $category->id }}</td>
					<td>{{ $category->name }}</td>
					<td>
						<a href="" class="btn btn-default btn-xs">Edit</a>
						<a href="{{ route('admin.categories.del', [$category->id]) }}" class="btn btn-danger btn-xs">Delete</a>						
					</td>
				</tr>
					@if($category->childs->count())
						@foreach($category->childs as $child)
							<tr>
								<td>{{ $child->id }}</td>
								<td>-{{ $child->name }}</td>
								<td>
									<a href="" class="btn btn-default btn-xs">Edit</a>
									<a href="{{ route('admin.categories.del', [$child->id]) }}" class="btn btn-danger btn-xs">Delete</a>
								</td>
							</tr>
						@endforeach
					@endif

			@endforeach
				</tbody>
			</table>

		</div>	
	</div>
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

		$('#nume').on('change, keyup', function(){
			$('#slug').val( convertToSlug($('#nume').val()) );
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