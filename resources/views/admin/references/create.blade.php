@extends('admin.layouts.master')

@section('page', 'Create Reference')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			<form action="{{ route('admin.post.references') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="">Articol</label>
					<select name="parent" id="" class="form-control">
						<option value=""> - Select - </option>
						<option value=""> - </option>
						@foreach($lessons as $lesson)
							<option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
						@endforeach
						<option value=""> - </option>
						@foreach($articles as $article)
							<option value="{{ $article->id }}">{{ $article->name }}</option>
						@endforeach					
					</select>
				</div>

				<div class="form-group">
					<label for="">Refereinta</label>
					<select name="reference" id="" class="form-control">
						<option value=""> - Select - </option>
						@foreach($articles as $article)
							<option value="{{ $article->id }}">{{ $article->name }}</option>
						@endforeach											
					</select>
				</div>
				<div class="form-group">
					<label for="type">Tip</label>
					<select name="type" id="" class="form-control">
						<option value=""> - Select - </option>
						<option value="0">Lectie</option>
						<option value="1">Articol</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right" value="Submit">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
@endsection