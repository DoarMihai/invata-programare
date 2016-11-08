@extends('layouts.master')

@section('title', $category->name.' - '.$defaultTitle )

@section('content')
	@if($articles->count())
		<div class="page-title">
			<img src="{{ asset('img/archive.png') }}" alt=""> {{ $category->name }}
		</div>
		@if($category->slug == 'snippets')
			@foreach($articles as $article)
			<article class="post">
				<div class="row">
					<div class="col-md-1 {{ snippetColor($article->categories[1]->id) }}">
						{{ $article->categories[1]->name }}
					</div>
					<div class="col-md-11">
						<h3><a href="{{ route('article', $article->slug) }}">{{$article->name}}</a></h3>
					</div>
				</div>
			</article>
			@endforeach
			{!! $articles->render() !!}				
		@else
			@foreach($articles as $article)
			<article class="post">
				<h3><a href="{{ route('article', $article->slug) }}">{{$article->name}}</a></h3>
				<span class="meta">
					postat {{ Carbon::parse($article->created_on)->diffForHumans() }} de <a href="">{{ $article->creator->name }}</a>
					<em class="pull-right">{{ count($article->comments) }} {{ count($article->comments) == 1 ? 'comentariu' : 'comentarii' }}</em>
				</span>
				<div class="row">
					@if(isset($article->picture) && !empty($article->picture) )
					<div class="col-md-3">
						<img src="{{ asset('uploads/thumbnails/'.$article->picture) }}" alt="" class="img img-responsive">
					</div>
					<div class="col-md-9">
						{{ strip_tags( substr($article->content, 0, 300) ).'...' }}
						<br>
						<a href="{{ route('article', $article->slug) }}" class="btn btn-default pull-right">Citeste Articolul &rarr;</a>
					</div>
					@else
						<div class="col-md-12">
							{{ strip_tags( substr($article->content, 0, 120) ).'...' }}						
						</div>
					@endif
				</div>
			</article>
			@endforeach
			{!! $articles->render() !!}
		@endif
	@endif
@endsection