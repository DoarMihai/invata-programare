<aside class="sidebar">
	<section>
		<h4>Admin</h4>
		<span>
			Salut {{ Auth::user()->name }}!
			<span class="pull-right"><a href="{{ url('account/logout') }}"><i class="fa fa-power-off"></i> Logout</a></span>
		</span>
		<ul class="bar">
			<li><a href="{{ url('admin') }}"><i class="fa fa-cloud"></i> Dashboard</a></li>
			<li><a href="{{ url('admin/article/new') }}"><i class="fa fa-pencil-square"></i> New Article</a></li>
			<li><a href="{{ url('admin/comments') }}"><i class="fa fa-comments-o"></i> Comments</a></li>
		</ul>
	</section>
</aside>