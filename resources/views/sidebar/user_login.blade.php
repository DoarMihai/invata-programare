<aside class="sidebar">
	<section>
		<h4>Autentificare</h4>
		<div class="login-side" style="padding: 0px 15px">
			<form action="{{ route('user.login.post') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="email" placeholder="emailul tau" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Parola</label>
					<input type="password" name="password" palceholder="parola ta" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" value="Login!" class="btn btn-primary pull-right">
				</div>
				<div class="clearfix"></div>
			</form>
			<hr>
			<ul class="auth-sidebar-links">
				<li><a href="{{ route('user.register') }}"><i class="fa fa-user-plus"></i> Inregistrare</a></li>
				<li><a href="{{ route('user.forgot') }}"><i class="fa fa-life-bouy"></i> Recuperare parola</a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</section>
</aside>