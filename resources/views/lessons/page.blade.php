@extends('layouts.master')

@section('title', $lesson->name.' - '.$defaultTitle )
@section('meta')
	@if( isset($lesson->description) && !empty($lesson->description) && isset($lesson->picture) )
	<meta property="og:url"                content="{{ route('lesson', $lesson->slug) }} " />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="{{ $lesson->name }}" />
	<meta property="og:description"        content="{{ $lesson->description }}" />
	<meta property="og:image"              content="http://www.invata-programare.ro/uploads/lessons/pictures/{{ $lesson->picture }}" />	
	@endif
@endsection

@section('content')
	@if( isset($lesson->description) && !empty($lesson->description) && isset($lesson->picture) )
	<br>
	<div class="row">
		<div class="col-md-3">
			<img src="{{ asset('/uploads/lessons/pictures/'.$lesson->picture) }}" alt="">
		</div>
		<div class="col-md-9">
			<p>{{ $lesson->description }}</p>
		</div>
	</div>
	<br>
	@endif

	<div class="lesson-page">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ $lesson->name }}</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ul>
				@foreach($articles as $key => $article)
					<li><a href="{{ route('article', $article->slug) }}">{{ $article->name }}</a></li>
					@if($key == 13)
						</ul><ul>
					@endif
				@endforeach
				</ul>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<span class="adsense">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- IP2 -->
				<ins class="adsbygoogle"
				     style="display:inline-block;width:728px;height:90px"
				     data-ad-client="ca-pub-1355755395825420"
				     data-ad-slot="7259002308"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>					
			</span>		
		</div>
	</div>

	@if( isset($references[0]) )
	<h3>Articole pe acealsi subiect:</h3>
	<div class="lesson-page">
		<div class="row">
			<div class="col-md-12">
				<ul>
				@foreach($references[0]->articles as $ref)
					<li><a href="">{{ $ref->name }}</a></li>
				@endforeach
				</ul>
			</div>
		</div>
	</div>
	@endif
@endsection