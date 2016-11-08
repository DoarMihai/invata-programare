@extends('admin.layouts.master')

@section('page', 'New Article')

@section('content')

	<div class="col-md-12">
		<div class="admin-bg">

			<div class="filters">
				<div class="row">
					
					<div class="col-md-2">
						<select name="category" id="filterCategory" class="form-control">
							<option value=""> - Select Category -</option>
							@foreach($categories as $category)
								<option value="{{ $category->id }}" {{ Input::get('category') !== null && Input::get('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2">
						<select name="status" id="filterStatus" class="form-control">
							<option value="0" {{ Input::get('status') !== null && Input::get('status') == 0 ? 'selected' : '' }}> - Select Status -</option>
							<option value="1" {{ Input::get('status') !== null && Input::get('status') == 1 ? 'selected' : '' }}> Published </option>
							<option value="2" {{ Input::get('status') !== null && Input::get('status') == 2 ? 'selected' : '' }}> Draft </option>
							<option value="3" {{ Input::get('status') !== null && Input::get('status') == 3 ? 'selected' : '' }}> Schedueled </option>
						</select>					
					</div>
					<div class="col-md-2">
						<select name="lesson" id="filterLesson" class="form-control">
							<option value="0"> - All - </option>
							<option value="1" {{ Input::get('lesson') !== null && Input::get('lesson') == 1 ? 'selected' : '' }}>Lessons</option>
							<option value="2" {{ Input::get('lesson') !== null && Input::get('lesson') == 2 ? 'selected' : '' }}>Articles</option>
						</select>
					</div>
				</div>
			</div>
			<br>

			@if($articles->count())
			<table class="posts-table table table-responsive table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Author</th>
						<th>Category</th>
						<th>Status</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $article)
						<tr>
							<td><h4><a href="{{ route('admin.edit.article', $article->id) }}">{{ $article->name }}</a></h4></td>
							<td><a href="">{{ $article->creator->name }}</a></td>
							<td>
								@foreach($article->categories as $category)
									<a href="">{{ $category->name }}</a>
								@endforeach
							</td>
							<td>
								@if( $article->status && strtotime($article->created_on) < strtotime(Carbon::now()->format('Y-m-d H:i:s')) )
									Published
								@elseif( strtotime($article->created_on) > strtotime(Carbon::now()->format('Y-m-d H:i:s')) )	
									Not active yet
								@else
									Draft
								@endif
							</td>
							<td>{{ Carbon::parse($article->created_on)->diffForHumans() }}</td>
							<td>
								<a href="{{ route('admin.edit.article', $article->id) }}" class="btn btn-default btn-xs">Edit</a>
								<a href="{{ route('admin.delete.article', $article->id) }}" class="btn btn-default btn-xs delete-article">Delete</a>
								@if($article->status)
									<a href="" class="btn btn-default btn-xs">Publish</a>
								@else
									<a href="" class="btn btn-default btn-xs">Make Draft</a>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{!! $articles->appends(['category' => Input::get('category'), 'status' => Input::get('status'), 'lesson' => Input::get('lesson')])->render() !!}
			@else
				<em>There are no articles</em>
			@endif
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		$('.delete-article').on('click', function(e){
			e.preventDefault();
				$.ajax({
					url: $(this).attr('href')
				});
				$(this).parent().parent().remove();
			return false;
		});
		$('#filterCategory').on('change', function(){
			// var link = '/admin/articles/category/'+$(this).val();
			var link = '?category='+$(this).val();
			window.location.href = link;
		});
		$('#filterStatus').on('change', function(){
			var link = '?status='+$(this).val();
			window.location.href = link;
		});
		$('#filterLesson').on('change', function(){
			var link = '?lesson='+$(this).val();
			window.location.href = link;
		});		
	</script>
@endsection