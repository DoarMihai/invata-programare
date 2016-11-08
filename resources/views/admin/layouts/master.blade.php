<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin-folder/css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-folder/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-folder/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-folder/css/custom.css?version=1') }}">
    <meta name="csrf_token" ="{{ csrf_token() }}" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>I</b>P</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>IP</span>
            </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          @if( $contactMessages && $contactMessages->count() )
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">{{ $contactMessages->count() }}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{ $contactMessages->count() }} messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    @foreach($contactMessages as $msg)
                        <li><!-- start message -->
                            <a href="#">
                             <div class="pull-left">
                                    <img src="{{ URL::asset('img/contact_small.png') }}" class="img-circle" alt="User Image">
                                </div>
                                <h4>{{ substr($msg->name, 0, 25) }}<small><i class="fa fa-clock-o"></i> {{ Carbon::parse($msg->sent_on)->diffForHumans() }}</small></h4>
                                <p>{{ messageSubject($msg->subject) }}</p>
                            </a>
                        </li>
                        <!-- end message -->
                    @endforeach
                </ul>
              </li>
              <li class="footer"><a href="{{ route('admin.contact') }}">See All Messages</a></li>
            </ul>
          </li>
            @endif
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('uploads/users/'.Auth::user()->pic) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
          </li>
          <li>
              <a href="{{ url('account/logout') }}">Logout</a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('uploads/users/'.Auth::user()->pic) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-circle-o"></i>Admin</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i>Setting</a></li>
            </ul>
        </li>
        <li class="{{ (isset($page) && ($page == 'new_article' || $page == 'articles' || $page == 'edit_article')) ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Articles</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ isset($page) && $page == 'articles' ? 'active' : '' }}"><a href="{{ route('admin.articles') }}"><i class="fa fa-circle-o"></i> Articles</a></li>
            <li class="{{ isset($page) && $page == 'new_article' ? 'active' : '' }}"><a href="{{ route('admin.create.article') }}"><i class="fa fa-circle-o"></i> New Article</a></li>
            <li><a href="{{ route('admin.categories') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
          </ul>
        </li>

        <li class="{{ (isset($page) && ($page == 'lessons' || $page == 'new_lesson')) ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Lessons</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (isset($page) && ($page == 'lessons')) ? 'active' : '' }}"><a href="{{ route('admin.lessons') }}"><i class="fa fa-circle-o"></i> Lessons</a></li>
            <li class="{{ (isset($page) && ($page == 'new_lesson')) ? 'active' : '' }}"><a href="{{ route('admin.lessons.create') }}"><i class="fa fa-circle-o"></i> New Lesson</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Sections</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> New Section</a></li>
          </ul>
        </li>

        <li class="{{ (isset($page) && $page == 'forums') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Forums</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ (isset($page) && ($page == 'forum_categories')) ? 'active' : '' }}"><a href="{{ route('admin.forum.categories') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
            <li class="{{ (isset($page) && ($page == 'forum_categories')) ? 'active' : '' }}"><a href=""><i class="fa fa-circle-o"></i> Threads</a></li>
            <li class="{{ (isset($page) && ($page == 'forum_categories')) ? 'active' : '' }}"><a href=""><i class="fa fa-circle-o"></i> Posts</a></li>
          </ul>
        </li>

        <li><a href="{{ route('admin.users') }}"><i class="fa fa-th"></i> <span>Users</span></a>

        <li class="{{ isset($page) && ( $page == 'pages' || $page == 'new_page' ) ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-file-word-o"></i>
            <span>Pages</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ isset($page) && $page == 'pages' ? 'active' : '' }}"><a href="{{ route('admin.pages') }}"><i class="fa fa-circle-o"></i> Pages</a></li>
            <li class="{{ isset($page) && $page == 'new_page' ? 'active' : '' }}"><a href="{{ route('admin.pages.create') }}"><i class="fa fa-circle-o"></i> New page</a></li>
          </ul>
        </li>

        <li class="{{ isset($page) && $page == 'contact' ? 'active' : '' }}"><a href="{{ route('admin.contact') }}"><i class="fa fa-envelope"></i> <span>Contact</span></a>
        <li class="{{ isset($page) && $page == 'comments' ? 'active' : '' }}"><a href="{{ route('admin.comments') }}"><i class="fa fa-comments"></i> <span>Comments</span></a>
        <li class="{{ isset($page) && $page == 'announcements' ? 'active' : '' }}"><a href="{{ route('admin.announcements') }}"><i class="fa fa-bell-o"></i> <span>Anunturi</span></a>
        <li class="{{ isset($page) && $page == 'ref' ? 'active' : '' }}"><a href="{{ route('admin.create.references') }}"><i class="fa fa-bell-o"></i> <span>References</span></a>

        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>@yield('page')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
            @yield('content')
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="max-height: 45px;">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright Invata-Programare &copy; 2011-2016 <a href="http://cmconline.xyz">CMCOnline</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('admin-folder/css/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-folder/js/app.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@yield('scripts')
</body>
</html>
