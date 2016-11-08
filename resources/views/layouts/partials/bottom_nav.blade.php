<!-- SECOND MENU -->
<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand hidden-md hidden-lg" href="#">Menu</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li> -->
        <li><a href="{{ route('category', ['inoob']) }}">iNoob</a></li>
        <li><a href="{{ route('page', ['almanach']) }}">Almanach</a></li>
        <li><a href="/category/snippets">Snippets</a></li>
        <li><a href="{{ route('forum.index') }}" style="color: red;">Forums</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- SECOND MENU -->