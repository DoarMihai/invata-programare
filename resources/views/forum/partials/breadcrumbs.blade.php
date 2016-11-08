<div class="row">
	<div class="col-md-12">
		<div class="breadcrumbs-container">
			<ol class="breadcrumb forum-bc">
			  <li><a href="{{ route('home') }}">Home</a></li>
			  <li><a href="{{ route('forum.index') }}">Forums</a></li>
				@if( isset($thread) && $thread && !isset($topic) )
					<li class="active">{{ $thread['name'] }}</li>
				@elseif(isset($thread) && $thread && isset($topic))
					<li class="active"><a href="{{ route('forum.thread.index', $thread['slug']) }}">{{ $thread['name'] }}</a></li>
				@endif

				@if( isset($topic) && $topic )
					<li class="active">{{ $topic['name'] }}</li>
				@endif
			</ol>			
		</div>
	</div>
</div>

@if(!Auth::check())
	<div class="row">
		<div class="col-md-12">
			<a href="{{ route('user.register') }}"><i class="fa fa-plus-circle"></i> Register</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="{{ route('user.login') }}"><i class="fa fa-key"></i> Login</a>
		</div>
	</div>
@endif