@extends('admin.layouts.master')

@section('page', 'Pages')

@section('content')
	<div class="col-md-12">
		<div class="admin-bg">
			@if(isset($messages) && $messages->count())
			<table class="posts-table table table-responsive table-striped table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Subject</th>
						<th>Status</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($messages as $message)
						<tr>
							<td><h4>{{ $message->name }}</h4></td>
							<td>{{ $message->email }}</td>
							<td>{{ messageSubject($message->subject) }}</td>
							<td class='msgStatus' data-status="{{ $message->status }}">{{ messageStatus($message->status) }}</td>
							<td>{{ Carbon::parse($message->sent_on)->diffForHumans() }}</td>
							<td>
								<a href="{{ route('admin.contact.read', $message->id) }}" class="btn btn-default btn-xs">Read</a>
								<a href="{{ route('admin.contact.markread', $message->id) }}" class="btn btn-default btn-xs markRead">{{ $message->status ? 'Mark Unread' : 'Mark Read' }}</a>
								<a href="{{ route('admin.pages.edit', $message->id) }}" class="btn btn-default btn-xs">Edit</a>
								<a href="{{ route('admin.contact.delete', $message->id) }}" class="btn btn-default btn-xs delete-page">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{!! $messages->render() !!}
			@else
				<em>No messages available.</em>
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
				//change status
				$(this).parent().prev().prev().text('Citit');
				//change btn text
				$(this).text('Mark Unread');
			return false;
		});
	</script>
@endsection