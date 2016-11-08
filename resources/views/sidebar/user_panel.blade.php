<aside class="sidebar">
	<section>
		<h4>My Profile</h4>
		<span>
			Salut <a href="{{ route('profile.index', Auth::user()->id) }}">{{ Auth::user()->name }}</a>!
			<span class="pull-right"><a href="{{ url('account/logout') }}"><i class="fa fa-power-off"></i> Logout</a></span>
		</span>
		
		<div class="user_panel_avatar">
			@if(Auth::user()->pic)
				<img src="{{ asset('uploads/users/'.Auth::user()->pic) }}" alt="" class="img img-responsive">			
			@else
				<img src="{{ asset('img/no-avatar.png') }}" alt="" class="img img-responsive">			
			@endif
		</div>

		<br>
		<div class="text-center">
			<img src="{{ asset('img/pepsi.png') }}" alt="" title="Pepsi cans"> {{ Auth::user()->points }}
			<img src="{{ asset('img/clipboard.png') }}" alt="" title="Postari pe forum"> {{ Auth::user()->posts->count() }}
			<img src="{{ asset('img/speechbubbles.png') }}" alt="" title="Comentarii"> {{ Auth::user()->comments->count() }}
		</div>
		<hr>
		<ul>
			<li><a href="{{ route('user.edit') }}"><i class="fa fa-cloud"></i> Editare Profil</a></li>
			<li><a href="{{ route('user.portfolio.add') }}"><i class="fa fa-plus-square"></i> Adauga proiect in Portofoliu</a></li>
			<!-- <li><a href=""><i class="fa fa-pencil-square"></i> Editare Portofoliu</a></li> -->
			<!-- <li><a href=""><i class="fa fa-comments-o"></i> Comentariile mele</a></li> -->
			<!-- <li><a href=""><i class="fa fa-comments-o"></i> Postarile mele</a></li> -->
		</ul>
	</section>
</aside>