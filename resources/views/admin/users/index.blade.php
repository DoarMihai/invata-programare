@extends('admin.layouts.master')

@section('page', 'Users')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			@if($users->count())
			<table class="table table-bordered table-stripped table-condensed" style="background: #fff;">
				<thead>
					<tr>
						<th>Nume</th>
						<th>Email</th>
						<th>Clasa</th>
						<th>Rank</th>
						<th>Data</th>
						<th>OPtiuni</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)	
						<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ getRole($user->class) }}</td>
							<td>{{ $user->rank }}</td>
							<td>{{ $user->created_on }}</td>
							<td>
								<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
								<a href="" class="btn btn-default btn-xs"><i class="fa fa-close" aria-hidden="true"></i> Delete</a>
								<a href="" class="btn btn-default btn-xs"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mail</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			@endif
		</div>
	</div>
@endsection