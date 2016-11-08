<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<img src="http://invata-programare.ro/img/logo.png" alt="" class="img img-responsive">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4>Salut {{$user}}, la articolul <a href="{{ route('article', $article->slug) }}" target="_blank">{{ $article->name }}</a> a fost postat un nou comentariu.</h4>
				</div>
			</div>
		</div>
	</body>
</html>