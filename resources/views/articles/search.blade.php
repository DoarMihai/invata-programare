@extends('layouts.master')

@section('title', 'Cautare articole - '.$defaultTitle )

@section('content')
	@if($results->count())
		<br>
		<div class="alert alert-info">
			Cautarea ta dupa <em>"{{$q}}"</em> a returnat {{$results->count()}} rezultate!
		</div>
		@foreach($results as $article)
		<article class="post">
			<h3><a href="{{ route('article', $article->slug) }}">{{$article->name}}</a></h3>
			<span class="meta">
				postat {{ Carbon::parse($article->created_on)->diffForHumans() }} de <a href="">{{ $article->creator->name }}</a>
				<em class="pull-right">{{ count($article->comments) }} {{ count($article->comments) == 1 ? 'comentariu' : 'comentarii' }}</em>
			</span>
			<div class="row">
				@if(isset($article->picture))
				<div class="col-md-3">
					<img src="{{ asset('uploads/thumbnails/'.$article->picture) }}" alt="" class="img img-responsive">
				</div>
				<div class="col-md-9">
					{{ strip_tags( substr($article->content, 0, 300) ).'...' }}
					<br>
					<a href="{{ route('article', $article->slug) }}" class="btn btn-default pull-right">Citeste Articolul &rarr;</a>
				</div>
				@else
					<div class="col-md-12"></div>
				@endif
			</div>
		</article>
		@endforeach
		{!! $results->render() !!}
	@else
		<br>
		<div class="alert alert-info">
			Cautarea ta dupa <em>"{{$q}}"</em> nu a returnat niciun rezultat!
		</div>
	@endif
@endsection