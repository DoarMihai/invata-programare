@extends('admin.layouts.master')

@section('page', 'Anouncements')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			
			<div class="row">
				<div class="col-md-12">
					<a href="{{ route('admin.create.announcements') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Item</a>
				</div>
			</div><br>

			@if($anouncements->count())
			<table class="posts-table table table-responsive table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Content</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($anouncements as $anouncements)
						<tr>
							<td><h4><a href="{{ route('admin.edit.article', $anouncements->id) }}">{{ $anouncements->name }}</a></h4></td>
							<td>{!! $anouncements->content !!}</td>
							<td>
								<a href="{{ route('admin.edit.announcements', $anouncements->id) }}" class="btn btn-default btn-xs">Edit</a>
								<a href="{{ route('admin.delete.announcements', $anouncements->id) }}" class="btn btn-default btn-xs delete-page">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			@else
				<em>No anouncements available.</em>
			@endif
		</div>
	</div>
@endsection