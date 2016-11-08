@extends('layouts.master')

@section('title', 'Jobs - '.$defaultTitle )
@section('content')

<div class="job-search-form">
	<form action="" class="job-search">
		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search job">
				</div>
			</div>
			<div class="col-md-4">
				<button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
				<a href="{{ route('jobs.create') }}" class="btn btn-primary"> Add Job</a>
			</div>
		</div>	
	</form>	
</div>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4"></div>
	<div class="col-md-4"></div>
</div>		
@endsection