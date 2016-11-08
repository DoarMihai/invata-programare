@extends('layouts.master')

@section('title', $thread->name.' - '.$defaultTitle )
@section('meta')

@endsection

@section('content')
@include('forum.partials.breadcrumbs', ['thread' => ['slug' => $thread->slug, 'name' => $thread->name] ] )


<div class="row">
	<div class="col-md-12">
		<div class="lesson-page">
			<div class="pull-left">{{ $thread->name }}</div>
			@if( Auth::check() )
				<div class="pull-right"><a href="{{ route('forum.new.topic', $thread->id) }}" class="btn btn-primary btn-xs {{ Auth::check() ? '' : 'hide' }}"><i class="fa fa-pencil"></i> New Topic</a></div>
			@endif
			<div class="clearfix"></div>
		</div>
		@foreach($thread->topics as $topic)
			<div class="topic-line {{ $topic->closed ? 'closed-topic' : '' }}">
				<div class="row">
					<div class="col-md-6"><a href="{{ route('forum.topic.index', $topic->slug) }}">{{ $topic->name }}</a> <br> <span class="small-text">{{ $topic->description }}</span> </div>
					<div class="col-md-2">{{ $topic->posts->count() }} Posts</div>
					<div class="col-md-3">
						@if( lastTopicPost($topic->id) != NULL )
							Posted by <a href="{{ route('profile.index', lastTopicPost($topic->id)['user']['id']) }}">{{ lastTopicPost($topic->id)['user']['name'] }}</a> on {{ Carbon::parse(lastTopicPost($topic->id)['date'])->format('d.m.Y') }}
						@else
							<em>No Posts</em>
						@endif						
					</div>
				</div>
			</div>
		@endforeach

		@if( !count($thread->topics) )
			<div class="no-topics"><em>There are no topics in this thread! @if( Auth::check() ) Why don't you create the <a href="{{ route('forum.new.topic', $thread->id) }}">first topic</a>? @endif</em></div>
		@endif
	</div>
</div>
@endsection