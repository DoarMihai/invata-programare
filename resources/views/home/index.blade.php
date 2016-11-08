@extends('layouts.master')

@section('content')
	@if($articles->count())
		@foreach($articles as $key => $article)
		@if( !in_array($article->categories->first()->id, $excluded) )
		<article class="post">
			<h3><a href="{{ route('article', $article->slug) }}">{{$article->name}}</a></h3>
			<span class="meta">
				postat {{ Carbon::parse($article->created_on)->diffForHumans() }} de <a href="{{ route('profile.index', $article->creator->id) }}">{{ $article->creator->name }}</a>
				<em class="pull-right">
					<i class="fa fa-commenting-o"></i> {{ count($article->comments) }} {{ count($article->comments) == 1 ? 'comentariu' : 'comentarii' }}
					| <i class="fa fa-folder-open-o"></i> <a href="{{ route('category', $article->categories->first()->slug) }}">{{ $article->categories->first()->name }}</a>
				</em>
			</span>
			<div class="row">
				@if(isset($article->picture) && !empty($article->picture))
				<div class="col-md-3">
					<img src="{{ asset('uploads/thumbnails/'.$article->picture) }}" alt="{{$article->name}}" class="img img-responsive">
				</div>
				<div class="col-md-9">
					<span>{{ strip_tags( substr($article->content, 0, 300) ).'...' }}</span>
					<br>
					<a href="{{ route('article', $article->slug) }}" class="btn btn-default pull-right">Citeste Articolul &rarr;</a>
				</div>
				@else
				<div class="col-md-12">
					{{ strip_tags( substr($article->content, 0, 300) ).'...' }}
					<br>
					<a href="{{ route('article', $article->slug) }}" class="btn btn-default pull-right">Citeste Articolul &rarr;</a>
				</div>
				@endif
			</div>
		</article>
			@if($key == 0)
				<span class="adsense">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- ip1 v2 -->
					<ins class="adsbygoogle"
					     style="display:block"
					     data-ad-client="ca-pub-1355755395825420"
					     data-ad-slot="5706387109"
					     data-ad-format="auto"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>		
				</span>
			@endif
			@if($key == 1)
				<div class="course-ad">
					<div class="seo-lessons">
						<a href="{{ route('lesson', ['tehnici_seo_esentiale']) }}">Tutorial "Tehnici SEO esentiale"</a>
					</div>
				</div>
			@endif
		@endif
		@endforeach
		{!! $articles->render() !!}
	@endif
@endsection