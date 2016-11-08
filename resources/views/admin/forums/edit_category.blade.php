@extends('admin.layouts.master')

@section('page', 'Forum Categroies')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif		
				<form action="{{ route('admin.forum.edit_category') }}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="">Description</label>
						<input type="text" name="description" value="{{ $category->description }}" class="form-control" placeholder="Description">
					</div>
					<div class="form-group">
						<label for="">Icon</label>
						<input type="file">
					</div>
					<div class="form-group">
						<label for="">Order</label>
						<input type="text" name="order" value="{{ $category->order }}" class="form-control" placeholder="Order">
					</div>
					<div class="form-group">
						<span class="pull-right">
							<a href="{{ route('admin.forum.categories') }}" class="btn btn-default">Cancel</a>
							<input type="submit" class="btn btn-primary" value="Edit">
						</span>
						<br>
					</div>
				</form>
		</div>
	</div>
@endsection