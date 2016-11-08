@extends('admin.layouts.master')

@section('page', 'New Leson')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			<form action="{{ route('admin.lessons.create.post') }}" method="post" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="nume">Nume</label>
					<input type="text" name="nume" id="nume" class="form-control">
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" name="slug" id="slug" class="form-control">
				</div>
				<div class="form-group">
					<label for="content">Description</label>
					<textarea name="content" id="content" cols="30" rows="4" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="picture">Picture</label>
					<input type="file" id="picture" name="picture">
				</div>
				<div class="form-group">
					<input type="submit" value="Submit" class="btn btn-primary pull-right">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
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