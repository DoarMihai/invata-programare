@extends('admin.layouts.master')

@section('page', 'Pages')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			@if($pages->count())
			<table class="posts-table table table-responsive table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($pages as $page)
						<tr>
							<td><h4><a href="{{ route('admin.edit.article', $page->id) }}">{{ $page->name }}</a></h4></td>
							<td>
								<a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-default btn-xs">Edit</a>
								<a href="{{ route('admin.pages.delete', $page->id) }}" class="btn btn-default btn-xs delete-page">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{!! $pages->render() !!}
			@else
				<em>No pages available.</em>
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