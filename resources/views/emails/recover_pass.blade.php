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
					<h4>Salut {{$user}}, parola ta de pe site-ul <a href="http://www.invata-programare.ro" target="_blank">Invata-Programare</a> a fost resetata:</h4>
				</div>
				<div class="col-md-12">
					<strong>Noua parola: </strong> {{$new_pass}}
				</div>
			</div>
		</div>
	</body>
</html>