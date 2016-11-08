@extends('admin.layouts.master')

@section('page', 'Lessons')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			@if($lessons->count())
			<table class="posts-table table table-responsive table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($lessons as $lesson)
						<tr>
							<td><h4><a href="{{ route('admin.edit.article', $lesson->id) }}">{{ $lesson->name }}</a></h4></td>
							<td>
								<a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-default btn-xs">Edit</a>
								<a href="{{ route('admin.lessons.delete', $lesson->id) }}" class="btn btn-default btn-xs delete-page">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{!! $lessons->render() !!}
			@else
				<em>No lessons available.</em>
			@endif
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		$('.delete-page').on('click', function(e){
			e.preventDefault();
				$.ajax({
					url: $(this).attr('href')
				});
				$(this).parent().parent().remove();
			return false;
		});		
	</script>
@endsection