@extends('admin.layouts.master')

@section('content')
	<div class="dashboard-home">
		<div class="row">
			<div class="col-md-6">
				<div class="data-wrapper">
					<div class="row">
						<div class="col-md-12">
							<div class="title">
								Activity
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<i class="fa fa-users"></i> <span>{{ $users }} @if($users == 1) user @else users @endif / {{ $bannedUsers }} suspended</span><br>
							<i class="fa fa-comments"></i> <span>{{ $comments }} @if($comments == 1) comment @else comments @endif</span><br>
						</div>
						<div class="col-md-6">
							<i class="fa fa-pencil-square"></i> <span>{{ $articles }} @if($articles == 1) article @else articles @endif</span><br>
							<i class="fa fa-pencil-square"></i> <span>{{ $fposts }} @if($fposts == 1) post @else posts @endif</span><br>
						</div>
					</div>
				</div>
				<br>
				<div class="data-wrapper">
					<div class="row">
						<div class="col-md-12">
							<div class="title">
								Latest Forum posts
								<table class="table table-responsive table-condensed table-bordered">
									<thead>
										<tr>
											<th>Topic</th>
											<th>Author</th>
											<th>Date</th>
											<th>Options</th>
										</tr>
									</thead>
									<tbody>
										@foreach($latestForumPosts as $post)
											<tr>
												<th><small>{{ $post->topic_id }}</small></th>
												<th><small><a href="">{{ $post->author->name }}</a></small></th>
												<th><small>{{ $post->created_at->diffForHumans() }}</small></th>
												<th><small>
													<a href="" class="btn btn-xs btn-default">Edit</a>
													<a href="" class="btn btn-xs btn-default">View</a>
												</small></th>
											</tr>										
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>					
				</div>
			</div>
			<div class="col-md-6">
				<div class="data-wrapper">
					<div class="row">
						<div class="col-md-12">
							<div class="title">
								Latest Articles
							</div>
						</div>
					</div>

					@foreach($latestArticles as $article)
						<div class="row">
							<div class="col-md-12">
								<a href="">{{ $article->name }}</a>
							</div>
						</div>
					@endforeach
				</div>
				<br>
				<div class="data-wrapper">
					<div class="row">
						<div class="col-md-12">
							<div class="title">Latest Comments</div>
							<div class="row">
								<div class="col-md-12">
									@foreach($commentsList as $comm)
										<div class="row">
											<div class="col-md-9">
												<div class="dashboard-comment">
													<strong><a href="mailto: {{ $comm->email }}">{{ $comm->name }}</a></strong> <em>{{ Carbon::parse($comm->posted_on)->diffForHumans() }}</em> <br>
													<div>
														{{ substr(strip_tags($comm->content), 0, 75) }}...
													</div>
												</div>												
											</div>
											<div class="col-md-3">
												<a href="" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
												<a href="" class="btn btn-default btn-xs"><i class="fa fa-close"></i></a>
												<a href="" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
											</div>
										</div>
										<hr>
									@endforeach
								</div>
							</div>
						</div>				
					</div>				
				</div>				
			</div>
		</div>
	</div>
@endsection