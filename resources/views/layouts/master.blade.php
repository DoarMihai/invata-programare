<!DOCTYPE html>
<html lang="ro" xml:lang="ro" xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
		<title>@yield('title', 'Invata-Programare')</title>
		@yield('meta')	
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,900italic,900,700italic,700,500,500italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />	
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1.3" type="text/css" />
		<link rel="canonical" href="http://invata-programare.ro/" />
		<link rel="next" href="http://invata-programare.ro/?page=2" />		

		@if( isset($isArticle) && $isArticle )
			 <link rel="canonical" href="http://www.invata-programare.ro/article/{{ $data->slug }}">

			<meta property="og:url" content="http://www.invata-programare.ro/article/{{ $data->slug }}" />
			<meta property="og:type" content="article" />
			<meta property="og:title" content="{{ $data->name }}" />
			<meta property="og:description" content="{{ substr(strip_tags($data->content), 0, 160) }}" />
			<meta property="og:image" content="{{ asset('uploads/thumbnails/'.$data->picture) }}" />
		@else
			<link rel="canonical" href="http://www.invata-programare.ro">
			<meta name="keywords" content="@yield('keywords', 'free, educational, videos, tutorials, programming, learn, css, java, c++, android, python, javascript, php, html5, html, tutorial, mysql, ruby, incepator, introducere, ajax, game development, after effects, photoshop, jquery, source code, forum')">
			<meta name="description" content="@yield('description', 'Citeste sute de tutoriale de programare, game development, web design, video editing, 3D modeling, iPhone app development, Android app development si multe altele gratuit!')">
			<meta name="author" content="Stefanescu Mihai">
		@endif
		@yield('styles')
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript">
		var clicky_site_ids = clicky_site_ids || [];
		clicky_site_ids.push(100870923);
		(function() {
		  var s = document.createElement('script');
		  s.type = 'text/javascript';
		  s.async = true;
		  s.src = '//static.getclicky.com/js';
		  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
		})();
		</script>
		<script>
  			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  		ga('create', 'UA-58323615-1', 'auto');
  		ga('send', 'pageview');
		</script>
		<script type="text/javascript">
		    window.smartlook||(function(d) {
		    var o=smartlook=function(){ o.api.push(arguments)},s=d.getElementsByTagName('script')[0];
		    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
		    c.charset='utf-8';c.src='//rec.getsmartlook.com/bundle.js';s.parentNode.insertBefore(c,s);
		    })(document);
		    smartlook('init', 'f1537071bb64b74c632f82c4f50d85b9f563ad3e');
		</script>		

</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=890082217696425";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<header>
		@include('layouts.partials.top_nav')
		<div class="top-logo text-center">
			<a href="/">
				<img src="{{ asset('img/logo.png') }}" alt="Invata-programare - Tutoriale de programare oferite gratuit" class="resp-logo">
			</a>
		</div>
		@include('layouts.partials.bottom_nav')
	</header>

<!-- 	<div class="beta-version hidden-xs hidden-sm">
	<img src="{{ asset('img/beta-ribbon-left.gif') }}" alt="Beta version">
</div>
 -->
	@if($announcement)
		@if($announcement->start_date < date('Y-m-d H:m:i') && $announcement->end_date > date('Y-m-d H:m:i'))
		<br>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-info">
						<strong>{{ $announcement->name }}</strong>
						<br>{!! $announcement->content !!}
					</div>
				</div>
			</div>
		</div>
		@endif
	@endif

	<div class="container">
		<div class="row">
			<div class="col-md-{{ isset($fullPage) && $fullPage == 1 ? '12' : '8' }}">
				@yield('content')
			</div>
				<div class="col-md-4">
					@if(isset($references) && isset($references[0]) && $references && $references !== null)
						<aside class="sidebar">
							<section>
								<h4>Articole din serie</h4>
								<ul>
								@foreach($references as $ref)
									<li><a href="{{ route('article', [$ref->articles[0]->slug]) }}">{{ $ref->articles[0]->name }}</a></li>
								@endforeach
								</ul>
							</section>
						</aside>
					@endif
					<aside class="sidebar">
						@include('sidebar.search')
					</aside>

					@if( isset($data) && $data->lesson != 0)
						<!-- cuprins -->
						<aside class="sidebar">
							<section>
								<h4>Cuprins</h4>
								<ul>
									@foreach($lessonsList as $lesson)
										@if(isset($data) && $data->id == $lesson->id)
											<li><strong><a href="{{ route('article', $lesson->slug) }}">{{ $lesson->name }}</a></strong></li>
										@else
											<li><a href="{{ route('article', $lesson->slug) }}">{{ $lesson->name }}</a></li>
										@endif
									@endforeach
								</ul>
							</section>
						</aside>
					@endif

					@include('sidebar.list_items')
					@if( Auth::check() )
						@include('sidebar.user_panel')
					@else
						@include('sidebar.user_login')	
					@endif
					@include('sidebar.promoted_lesson')
					@include('sidebar.soon-lesson')
					@include('sidebar.facebook')
					<aside class="sidebar">
					@include('sidebar.partners')
					</aside>
					<span class="adsense">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- IP3 -->
						<ins class="adsbygoogle"
						     style="display:inline-block;width:336px;height:280px"
						     data-ad-client="ca-pub-1355755395825420"
						     data-ad-slot="8735735508"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>						
					</span>
				</div>
		</div>
	</div>

@include('layouts.partials.footer')
<script>
	var upTop = "{{ asset('http://www.invata-programare.ro/img/up.png') }}";
</script>
<script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/scrolltopcontrol.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<!--/ GTop.ro - (begin) v2.1/-->
<script type="text/javascript" language="javascript">
var site_id = 81140;
var gtopSiteIcon = 29;
var _gtUrl = (("https:" == document.location.protocol) ? "https://secure." : "http://fx.");
document.write(unescape("%3Cscript src='" + _gtUrl + "gtop.ro/js/gTOP.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<!--/ GTop.ro - (end) v2.1/-->
<noscript><p><img src="//stats.invata-programare.ro/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

@yield('scripts')

</body>
</html>