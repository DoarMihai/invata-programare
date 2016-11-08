<footer>
	<div class="container-fluid bottom-lessons">
		<div class="container">
			<div class="row">
				<div class="col-md-2"><a href="{{ route('lesson', ['toate_lectiile_html']) }}"><img src="{{ asset('uploads/lessons/html-course.png') }}" alt="Toate lectiile HTML"></a></div>
				<div class="col-md-2"><a href="{{ route('lesson', ['toate_lectiile_css']) }}"><img src="{{ asset('uploads/lessons/css-course.png') }}" alt="Toate lectiile CSS"></a></div>
				<div class="col-md-2"><a href="{{ route('lesson', ['toate_lectiile_php']) }}"><img src="{{ asset('uploads/lessons/php-course.png') }}" alt="Toate lectiile PHP"></a></div>
				<div class="col-md-2"><a href="{{ route('lesson', ['toate_lectiile_sql']) }}"><img src="{{ asset('uploads/lessons/sql-course.png') }}" alt="Toate lectiile SQL"></a></div>
				<div class="col-md-2"><a href="{{ route('lesson', ['toate_lectiile_sass_si_scss']) }}"><img src="{{ asset('uploads/lessons/sass-course.png') }}" alt="Toate lectiile SASS"></a></div>
				<div class="col-md-2"><a href="{{ route('lesson', ['toate_lectiile_regular_expressions']) }}"><img src="{{ asset('uploads/lessons/regex-course.png') }}" alt="Toate lectiile Regular Expression"></a></div>
			</div>
		</div>
	</div>
	<div class="container-fluid footer-info">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-3">
							<img src="{{ asset('uploads/users/1474577815.jpg') }}" alt="Stefanescu Mihai - autor invata-programare.ro" class="img img-responsive img-rounded">
						</div>
						<div class="col-md-9">
							Mihai este un tanar programator din Bucuresti ce lucreaza in PHP/Mysql (MySqli/PDO), Laravel, Wordpress, HTML5/CSS3 (inclusiv SASS), Photoshop si multe altele.							
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-links">
						<h5>Site <span>Navigation</span></h5>
						<ul>
							<li><a href="{{ route('page', 'link_to_us') }}">Link to us</a></li>
							<li><a href="">Carti Recomandate</a></li>
							<li><a href="">HTML Ipsum</a></li>
							<li><a href="">Coduri ISO 639</a></li>
							<li><a href="">Colori HEX</a></li>
							<li><a href="">Fonturi Standard</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<ul class="footer-social">
						<li><a href="https://www.facebook.com/invata.programare" target="_blank"><img src="{{ asset('uploads/social/facebook.png') }}" alt="Pagina de facebook"></a></li>
						<li><a href="https://twitter.com/doar_mihai" target="_blank"><img src="{{ asset('uploads/social/twitter.png') }}" alt="Cont de twitter"></a></li>
						<li><a href="https://plus.google.com/u/0/+DoarMihai" target="_blank"><img src="{{ asset('uploads/social/googleplus.png') }}" alt="Cont de Google+"></a></li>
						<li><a href="skype: mihaistefanescu92"><img src="{{ asset('uploads/social/skype.png') }}" alt="Skype me"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid colophon">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="footer-colophon">
						Website construit pe <a href="http://www.laravel.com" target="_blank">Laravel</a>, intretinut de <a href="">Stefanescu Mihai</a> si sustinut de <a href="">CMCOnline</a>.
					</div>				
				</div>
			</div>
		</div>
	</div>
	
</footer>