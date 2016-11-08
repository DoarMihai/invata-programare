@extends('layouts.master')

@section('title', 'Create Job - '.$defaultTitle )
@section('content')
<div class="clearfix"></div>
<div class="job-search-form">
	<div class="row">
		<div class="col-md-12">
			<form action="" class="job-search">
				<div class="form-group">
					<label for="">Denumire</label>
					<input type="text" class="form-control" placeholder="Denumire">
				</div>
				<div class="form-group">
					<label for="">Descriere</label>
					<textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="">Skills</label>
					<input type="text" class="form-control">
				</div>
			</form>	
		</div>
	</div>
	<div class="clearfix"></div>
</div>
@endsection