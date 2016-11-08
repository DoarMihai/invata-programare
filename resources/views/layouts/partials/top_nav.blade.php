<!-- FIRST MENU -->
<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand hidden-md hidden-lg" href="#">Invata-Programare</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home <span class="sr-only">(current)</span></a></li>
        <li class=""><a href="{{ route('contact') }}">Contact</a></li>
        <li class=""><a href="{{ route('page', ['despre_mine']) }}">About</a></li>
        <li class=""><a href="{{ route('page', ['resurse']) }}">Resources</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cursuri <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('lesson', 'toate_lectiile_html') }}">HTML</a></li>
            <li><a href="{{ route('lesson', 'toate_lectiile_css') }}">CSS</a></li>
            <li><a href="{{ route('lesson', 'toate_lectiile_php') }}">PHP</a></li>
            <li><a href="{{ route('lesson', 'toate_lectiile_sql') }}">SQL</a></li>
            <li><a href="{{ route('lesson', 'toate_lectiile_sass_si_scss') }}">Sass & Scss</a></li>
            <li><a href="{{ route('lesson', 'gulp') }}">GulpJs</a></li>
            <li><a href="{{ route('lesson', 'toate_lectiile_bootstrap') }}">Bootstrap</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('lesson', 'tehnici_seo_esentiale') }}">SEO</a></li>
            <li><a href="{{ route('lesson', 'google_maps_api') }}">Google Maps API</a></li>
            <li><a href="{{ route('lesson', 'toate_lectiile_polymer') }}">Polymer</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('lesson', ['toate_lectiile_python']) }}">Python</a></li>
            <li><a href="{{ route('lesson', 'toate_lectiile_regular_expressions') }}">Regular Expressions</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('lesson', 'photoshop') }}">Photoshop</a></li>
          </ul>
        </li>
      </ul>
      @if( !Auth::check() )
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('user.login') }}"><i class="fa fa-key"></i> Login</a></li>
        <li><a href="{{ route('user.register') }}"><i class="fa fa-user-plus"></i> Register</a></li>      
      </ul>
      @else
      <ul class="nav navbar-nav pull-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if(Auth::check() && Auth::user()->class == 10)
                <li><a href="/admin">Admin</a></li>
                <li class="divider"></li>
            @endif
            <li><a href="{{ route('profile.index', Auth::user()->id) }}">My Profile</a></li>
            <li><a href="/edit">Edit Profile</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('user.logout') }}">Logout</a></li>
          </ul>
        </li>      
    </ul>        
      @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- FIRST MENU -->