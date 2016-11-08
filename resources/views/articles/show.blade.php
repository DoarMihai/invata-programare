@extends('layouts.master')

@section('title', $data->name.' - '.$defaultTitle )

@section('content')
	@if($data)
		<article class="post">
			<h3>{{$data->name}}</h3>
			<span class="meta">
				postat {{ Carbon::parse($data->created_on)->diffForHumans() }} de <a href="{{ route('profile.index', $data->creator->id) }}">{{ $data->creator->name }}</a> in categorie <a href="{{ route('category', $data->categories->first()->slug) }}">{{ $data->categories->first()->name }}</a>
			</span>
			<div class="clearfix"></div>
				@if(isset($data->picture) && !empty($data->picture))
					<img src="{{ asset('uploads/thumbnails/'.$data->picture) }}" alt="" class="img img-responsive pull-left post-img">
				@endif
					{!! $data->content !!}
		</article>

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

		<div class="about-author">
			<div class="row">
				<div class="col-md-2">
					<img src="{{ asset('uploads/users/'.$data->creator->pic) }}" alt="" class="img img-responsive img-rounded">
				</div>
				<div class="col-md-10">
					{{ $data->creator->about }} <br>
					<a href="https://plus.google.com/communities/109189374432844129006" target="_blank"><span class="label label-danger">Google+ Community</span></a> 
					<a href="https://www.facebook.com/groups/722507984470686/" target="_blank"><span class="label label-primary">Facebook Group</span></a>
				</div>
			</div>
		</div>

		@if( Carbon::parse($data->created_on)->format('Y') < 2016 )
			<div class="outdated-article alert alert-info">
				<div class="row">
					<div class="col-md-12">
						Acest articol a fost mutat de pe vechea platforma. <br> Pentru orice eroare aparuta la mutare va rog sa ma <a href="{{ url('contact') }}">contactati</a>!
					</div>
				</div>
			</div>
		@endif

		@if( Session::has('success') )
		    <div class="alert alert-success">
        		{{ Session::get('success') }}
    		</div>
		@endif


		<div class="comment-form">
			<form action="{{ route('article.comment', $data->id) }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				{!! Honeypot::generate('my_name', 'my_time') !!}
				<input type="hidden" name="parent" value="0">
				<input type="hidden" name="faker" value="">
				<div class="form-group half-row">
					<label for="name">Nume *</label>
					<input type="text" name="name" class="form-control" id="name" required="required">
				</div>
				<div class="form-group half-row">
					<label for="email">Email *</label>
					<input type="email" name="email" class="form-control" id="email" required="required">
				</div>
				<div class="form-group half-row">
					<label for="website">Website</label>
					<input type="text" name="website" class="form-control" id="website">
				</div>
				<div class="form-group">
					<label for="content">Comentariu</label>
					<textarea name="content" id="content" cols="30" rows="4" class="form-control" required="required"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right" value="Post">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>

		<div class="comments-list" id="comments">		
			@foreach($data->comments as $comm)
				@if($comm->status)
				<div class="comment">
					<div class="row">
						<div class="col-md-2">
							<img src="http://www.gravatar.com/avatar/{{ md5($comm->email) }}?s=96" alt="" class="img img-responsive">
						</div>
						<div class="col-md-10">
						<?php 
						if (strpos($comm->website,'http://') === false){
							$site = 'http://'.$comm->website;
						}else{
							$site = $comm->website;
						}
						 ?>
							<div class="meta">Comentariu postate de @if($comm->website)<a href="{{ $site }}" target="_blank" rel="nofollow">@endif <strong>{{ $comm->name }}</strong> @if($comm->website)</a>@endif 
							@if(Carbon::parse($comm->posted_on)->format('Y') > 2016)
								la data de {{ Carbon::parse($comm->posted_on)->format('d.m.Y') }}
							@endif
							</div>
							<div class="content">
							<?php  
							$text = $comm->content;
							$reg_exUrl = "/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3})([\s.,;\?\!]|$)/";

							if (preg_match_all($reg_exUrl, $text, $matches)) {
							    foreach ($matches[0] as $i => $match) {
							        $text = str_replace(
							            $match,
							            '<a href="'.$matches[1][$i].'" target="_blank" rel="nofollow">'.$matches[1][$i].'</a>'.$matches[3][$i],
							            $text
							        );
							    }
							}							
							?>

								{!! $text !!}
							</div>
						</div>
					</div>
				</div>
				@endif
			@endforeach

		</div>
	@endif
@endsection
@section('scripts')
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shCore.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shBrushJScript.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shBrushPhp.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shBrushBash.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shBrushCss.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shBrushSql.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shBrushSass.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shBrushJava.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/syntaxhighlighter/scripts/shBrushPython.js') }}"></script>

	<link type="text/css" rel="stylesheet" href="{{ asset('js/syntaxhighlighter/styles/shCoreDefault.css') }}"/>
	<script type="text/javascript">SyntaxHighlighter.all();</script>
@endsection