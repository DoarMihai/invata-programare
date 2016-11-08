@extends('admin.layouts.master')

@section('page', 'Forum Categroies')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			@if($categories->count())
				<table class="posts-table table table-bordeed table-striped table-condensed">
					<thead>
						<tr>
							<th>Icon</th>
							<th>Name</th>
							<th>Description</th>
							<th>Order</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td>{{ $category->Icon }}</td>
							<td>{{ $category->name }}</td>
							<td>{{ $category->description }}</td>
							<td>{{ $category->order }}</td>
							<td>
								<a href="{{ route('admin.forum.edit_category', $category->id) }}" class="btn btn-default btn-xs"> <i class="fa fa-pencil"></i> Edit</a>								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<em>No categories available.</em>
			@endif
		</div>
	</div>
@endsection
@section('scripts')
	<script>

	</script>
@endsection