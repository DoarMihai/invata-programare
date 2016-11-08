@extends('layouts.master')

@section('title', 'Forums - '.$defaultTitle )
@section('meta')
@endsection

@section('styles')
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('ckeditor/toolbarconfigurator/lib/codemirror/neo.css') }}" />
@endsection

@section('content')
@include('forum.partials.breadcrumbs', ['topic' => ['slug' => $topic->slug, 'name' => $topic->name], 'thread' => ['slug' => getThreadData($topic->thread_id)->slug, 'name' => getThreadData($topic->thread_id)->name]] )

@if( Auth::check() )
	@if(Auth::user()->id == $topic->posted_by)
		<div class="row">
			<div class="col-md-12">
				<span class="pull-right">
					<a href="" class="btn btn-default btn-xs"> <i class="fa fa-pencil-square"></i> Edit Topic</a>
					@if( !$topic->closed )
						<a href="{{ route('forum.topic.status', $topic->id) }}" class="btn btn-danger btn-xs"> <i class="fa fa-ban"></i> Close Topic</a>
					@else
						<a href="{{ route('forum.topic.status', $topic->id) }}" class="btn btn-success btn-xs"> <i class="fa fa-circle-o"></i> Open Topic</a>
					@endif
				</span>
			</div>
		</div>
	@endif
@endif
<div class="row">
	<div class="col-md-12">
		<div class="lesson-page">{{ $topic->name }}</div>
		@foreach($topic->posts as $post)
		@if(!$post->deleted)
			<div class="topic-post">
			<div class="row">
				<div class="col-md-3">
					<span class="forum-user-name"><a href="{{ route('profile.index', $post->posted_by) }}">{{ getUser($post->posted_by)->name }}</a></span>
					<span class="forum-avatar">
						<img src="{{ isset(getUser($post->posted_by)->pic) && !empty(getUser($post->posted_by)->pic) ? asset('uploads/users/'.getUser($post->posted_by)->pic) : asset('img/no-avatar.png') }}" alt="" class="img img-responsive">
					</span>

					<span class="forum-memeber-info">
						<ul>
							<li>{{ getRole( $post->author->class ) }}</li>
							<li>{{ usersPost($post->posted_by) }} Posts</li>
						</ul>
							<!-- contact -->
								@if(isset(getUser($post->posted_by)->contact) && getUser($post->posted_by)->contact != null && isset(getUser($post->posted_by)->contact[0]))
									@if(isset(getUser($post->posted_by)->contact[0]->facebook) && getUser($post->posted_by)->contact[0]->facebook != null)
										<a href="{{ getUser($post->posted_by)->contact[0]->facebook }}" target="_blank"><img src="{{ asset('img/social/fb.png') }}" alt="Facebook account" width="20"></a>
									@endif
									@if(isset(getUser($post->posted_by)->contact[0]->twitter) && getUser($post->posted_by)->contact[0]->twitter != null)
										<a href="{{ getUser($post->posted_by)->contact[0]->twitter }}" target="_blank"><img src="{{ asset('img/social/tw.png') }}" alt="Twitter account" width="20"></a>
									@endif
									@if(isset(getUser($post->posted_by)->contact[0]->gplus) && getUser($post->posted_by)->contact[0]->gplus != null)
										<a href="{{ getUser($post->posted_by)->contact[0]->gplus }}" target="_blank"><img src="{{ asset('img/social/gp.png') }}" alt="Google plus account" width="20"></a>
									@endif
									@if(isset(getUser($post->posted_by)->contact[0]->linkedin) && getUser($post->posted_by)->contact[0]->linkedin != null)
										<a href="{{ getUser($post->posted_by)->contact[0]->linkedin }}" target="_blank"><img src="{{ asset('img/social/li.png') }}" alt="LinkedIn account" width="20"></a>
									@endif
									@if(isset(getUser($post->posted_by)->contact[0]->skype) && getUser($post->posted_by)->contact[0]->skype != null)
										<a href="{{ $data->contact[0]->skype }}" target="_blank"><img src="{{ asset('img/social/sk.png') }}" alt="Skype account" width="20"></a>
									@endif								
								@endif
					</span>

				</div>
				<div class="col-md-9">
					<div class="small post-date" style="display: block;border-bottom: 1px solid #ccc;min-height: 27px;margin-bottom: 5px;">
						<span class="pull-left">posted on {{ $post->created_at }}</span>
						@if( Auth::check() && $post->posted_by == Auth::user()->id )
							<span class="pull-right">
								<a href="{{ url('forums/topic_edit/'.$topic->slug.'/'.$post->id) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i> Edit</a>
								<a href="{{ route('forum.post.delete', $post->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-eraser"></i> Delete</a>
							</span>
						@endif
					</div>
					<div class="clearfix"></div>
					@if($post->created_at < '2016-09-17')
						{!! xss_clean($post->content) !!}
					@else
						{!! html_entity_decode($post->content) !!}
					@endif
				</div>
			</div>
			</div>
		@endif
		@endforeach
		<br>
		@if(!$topic->closed)
			@if(Auth::check())
				<div class="topic-reply">
					<form action="{{ route('forum.topic.post', $topic->slug) }}" method="POST">
						<div class="form-group">
							<textarea name="content" id="replyEditor" cols="30" rows="4" class="form-control"></textarea>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</div>
						<div class="form-group">
							<input type="submit" class="pull-right btn btn-primary" value="Post">
						</div>
					</form>
				</div>
			@else
				<div class="alert alert-info">Trebuie sa fii <a href="{{ route('user.register') }}">inregistrat</a> sau <a href="{{ route('user.login') }}">autentificat</a> pentru a posta!</div>
			@endif
		@else
			<div class="alert alert-info">This topic was closed by admin</div>
		@endif
	</div>
</div>
<br>
@endsection

@section('scripts')
	<script>
		CKEDITOR.replace( 'replyEditor' );
	</script>
@endsection