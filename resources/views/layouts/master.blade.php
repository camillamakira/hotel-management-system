
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name')}} | Hotel Management System</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      @if (Auth::user()->role == 'admin')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Admin Dashboard</a>
      </li>
      @elseif (Auth::user()->role == 'manager')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Manager Dashboard</a>
      </li>
      @else
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">User Dashboard</a>
      </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
      <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
      <form class="form-inline">
      <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
      <button class="btn btn-navbar" type="submit">
      <i class="fas fa-search"></i>
      </button>
      <button class="btn btn-navbar" type="button" data-widget="navbar-search">
      <i class="fas fa-times"></i>
      </button>
      </div>
      </div>
      </form>
      </div>
      </li>

      <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-comments"></i>
      <span class="badge badge-danger navbar-badge">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <a href="#" class="dropdown-item">

      <div class="media">
      <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
      <div class="media-body">
      <h3 class="dropdown-item-title">
      Brad Diesel
      <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
      </h3>
      <p class="text-sm">Call me whenever you can...</p>
      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
      </div>
      </div>

      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">

      <div class="media">
      <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
      <div class="media-body">
      <h3 class="dropdown-item-title">
      John Pierce
      <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
      </h3>
      <p class="text-sm">I got your message bro</p>
      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
      </div>
      </div>

      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">

      <div class="media">
       <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
      <div class="media-body">
      <h3 class="dropdown-item-title">
      Nora Silvester
      <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
      </h3>
      <p class="text-sm">The subject goes here</p>
      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
      </div>
      </div>

      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
      </li>

      <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-item dropdown-header">15 Notifications</span>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
      <i class="fas fa-envelope mr-2"></i> 4 new messages
      <span class="float-right text-muted text-sm">3 mins</span>
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
      <i class="fas fa-users mr-2"></i> 8 friend requests
      <span class="float-right text-muted text-sm">12 hours</span>
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
      <i class="fas fa-file mr-2"></i> 3 new reports
      <span class="float-right text-muted text-sm">2 days</span>
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
      </li>
      <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <img src="dist/img/user.png" class="user-image img-circle elevation-2" alt="User Image">
      <span class="d-none d-md-inline">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

      <li class="user-header bg-primary">
      <img src="dist/img/user.png" class="img-circle elevation-2" alt="User Image">
      <p>
      {{Auth::user()->first_name}} {{Auth::user()->last_name}} - {{Auth::user()->role}}
      <small>Member since Nov. 2012</small>
      </p>
      </li>

      <li class="user-footer">
      <a href="{{url('profile')}}" class="btn btn-default btn-flat">Profile</a>
      <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right" 
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        Sign out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
      </li>
      </ul>
      </li>
      <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
      <i class="fas fa-expand-arrows-alt"></i>
      </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
        @include('layouts.menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Hotel management system
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 <a href="#">{{config('app.name')}}</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
