@extends('layouts.master')

@section('title', 'Forums - '.$defaultTitle )
@section('content')
@include('forum.partials.breadcrumbs')
<div class="row">
	<div class="col-md-12">
		@foreach($categories as $category)
			<div class="lesson-page">
				<div class="pull-left">{{ $category->name }}</div>
				@if(Auth::check() && Auth::user()->class > 8)
					<div class="pull-right"><a href="{{ route('forum.new.thread', $category->id) }}" class="btn btn-primary btn-xs {{ Auth::check() ? '' : 'hide' }}"><i class="fa fa-pencil"></i> New Thread</a></div>
				@endif
				<div class="clearfix"></div>
			</div>
			@foreach($category->threads as $thread)
				<div class="thread-line">
					<div class="row">
						<div class="col-md-1"><img src="{{ asset('img/thread.png') }}" alt="" width="48"></div>
						<div class="col-md-5"><a href="{{ route('forum.thread.index', $thread->slug) }}">{{ $thread->name }}</a> <br> {{ $thread->description }} </div>
						<div class="col-md-3">{{ $thread->topics->count() }} Topics/{{ getPostsNo($thread->id) }} Posts</div>
						<div class="col-md-3">
							@if( lastPost($thread->id) != NULL )
								Posted by <a href="{{ route('profile.index', lastPost($thread->id)['user_id']) }}">{{ lastPost($thread->id)['username'] }}</a> on 
								{{ Carbon::parse(lastPost($thread->id)['date'])->format('d.m.Y') }}
							@else
								<em>No Posts</em>
							@endif								
						</div>
					</div>
				</div>
			@endforeach
		@endforeach
	</div>
</div>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4"></div>
	<div class="col-md-4"></div>
</div>		


@endsection