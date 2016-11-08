@extends('admin.layouts.master')

@section('page', 'Forum Threads')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			@if($threads->count())
				<table class="posts-table table table-bordeed table-striped table-condensed">
					<thead>
						<tr>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						@foreach($threads as $thread)
						<tr>
							<td>
								<a href=""><i class="fa fa-pencil"></i> Edit</a>
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