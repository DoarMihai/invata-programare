@extends('admin.layouts.master')

@section('page', 'Edit User')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">

			<form action="{{ route('admin.users.edit.post', $user->id) }}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="fom-group">
					<label for="">Name</label>
					<input type="text" name="name" value="{{ $user->name }}" class="form-control">
				</div>
				<div class="fom-group">
					<label for="">Email</label>
					<input type="email" name="email" value="{{ $user->email }}" class="form-control">
				</div>
				<div class="fom-group">
					<label for="">Class</label>
					<select name="class" class="form-control" id="">
						<option value="1" {{ $user->class == 1 ? 'selected' : '' }}>Junior Member</option>
				        <option value="2" {{ $user->class == 2 ? 'selected' : '' }}>Member</option>
				        <option value="3" {{ $user->class == 3 ? 'selected' : '' }}>Power Member</option>
				        <option value="4" {{ $user->class == 4 ? 'selected' : '' }}>Legend</option>
				        <option value="5" {{ $user->class == 5 ? 'selected' : '' }}>Author</option>
				        <option value="6" {{ $user->class == 6 ? 'selected' : '' }}>Moderator</option>
				        <option value="7" {{ $user->class == 7 ? 'selected' : '' }}>Administrator</option>
				        <option value="8" {{ $user->class == 8 ? 'selected' : '' }}>Not Set</option>
				        <option value="9" {{ $user->class == 9 ? 'selected' : '' }}>Not Set</option>
				        <option value="10" {{ $user->class == 10 ? 'selected' : '' }}>Keymaster</option>
					</select>
				</div>
				<div class="fom-group">
					<label for="">Rank</label>
					<input type="text" name="rank" value="{{ $user->rank }}" class="form-control">
				</div>
				<div class="form-group">
					<br>
					<input type="submit" value="Edit" class="btn btn-primary pull-right">
					<br>
					<div class="cleafix"></div>
				</div>
			</form>
		</div>
	</div>
@endsection