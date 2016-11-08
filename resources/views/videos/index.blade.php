@extends('layouts.master')

@section('content')
		<article class="post">
			<form action="">
				<div class="row">
					<div class="col-md-4">
						<a href="" class="btn btn-primary"><i class="fa fa-user"></i></a> 
						<a href="" class="btn btn-primary"><i class="fa fa-plus"></i></a>
						<strong>Cauta recomandare: </strong>
					</div>
					<div class="col-md-8">
						<input type="text" class="form-control" placeholder="Cauta o recomandare">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-10">
						@foreach($cats as $cat)
							<input type="checkbox"> {{ $cat->name }}
						@endforeach
						cats
					</div>
					<div class="col-md-2">
						<a href="" class="btn btn-primary">Go</a>
					</div>
				</div>
			</form>
		</article>
	videos
@endsection