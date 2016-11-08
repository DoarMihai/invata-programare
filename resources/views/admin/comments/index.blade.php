@extends('admin.layouts.master')

@section('page', 'Comments')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			@if($comments->count())
			<table class="posts-table table table-responsive table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Website</th>
						<th width="45%">Content</th>
						<th>Article</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($comments as $comment)
						<tr>
							<td><h4>{{ $comment->name }}</h4></td>
							<td>{{ $comment->email }}</td>
							<td>{{ $comment->website }}</td>
							<td>{{ $comment->content }}</td>
							<td>{{ $comment->article->name }}</td>
							<td>{{ Carbon::parse($comment->posted_on)->format('Y-m-d H:i:s') }}</td>
							<td>
								@if( $comment->status )
									<a href="{{ route('admin.spam.mark', $comment->id) }}" class="btn btn-danger btn-xs markRead">Mark Spam</a>
								@else
									<a href="{{ route('admin.spam.mark', $comment->id) }}" class="btn btn-success btn-xs markRead">Not Spam</a>
								@endif
								<a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-default btn-xs">Edit</a>
								<a href="{{ route('admin.contact.delete', $comment->id) }}" class="btn btn-default btn-xs delete-page">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{!! $comments->render() !!}
			@else
				<em>No comments available.</em>
			@endif
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		$('.delete-page').on('click', function(e){
			e.preventDefault();
				$.ajax({
					url: $(this).attr('href')
				});
				$(this).parent().parent().remove();
			return false;
		});

		$('.markRead').on('click', function(e){
			e.preventDefault();
				$.ajax({
					url: $(this).attr('href')
				});
				//alert(1);

				$(this).addClass('btn-success');
				$(this).removeClass('btn-danger');
				$(this).text('Not Spam');
			return false;
		});
	</script>
@endsection