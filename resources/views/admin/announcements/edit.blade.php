@extends('admin.layouts.master')

@section('page', 'Pages')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			<form action="{{ route('admin.post.edit.announcements', [$data->id]) }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="name">Nume</label>
					<input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}">
				</div>
				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="content" id="content" cols="30" rows="4" class="form-control">{{ $data->content }}</textarea>
				</div>
				<div class="form-group">
					<label for="startDate">Data Start</label>
					<input type="text" name="startDate" id="startDate" class="form-control" value="{{ $data->start_date }}">
				</div>
				<div class="form-group">
					<label for="endDate">End Start</label>
					<input type="text" name="endDate" id="endDate" class="form-control" value="{{ $data->end_date }}">
				</div>
				<div class="form-group">
					<input type="submit" value="Edit" class="btn btn-primary pull-right">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
@endsection
@section('scripts')
		<script src="{{ asset('admin-folder/js/bootstrap-datepicker.js') }}"></script>
		<script>
			$('#startDate').datepicker()
			$('#endDate').datepicker()
		</script>
@endsection