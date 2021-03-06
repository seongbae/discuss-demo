<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Canvas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="icon" type="image/png" href="{{ asset('canvas/img/admin-favicon.png') }}">

  <link href="{{ asset('canvas/css/all.min.css') }}" rel="stylesheet" >
  <link href="{{ asset('canvas/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('canvas/css/adminlte.min.css') }}" rel="stylesheet">
  <link href="{{ asset('canvas/css/datatables.min.css') }}" rel="stylesheet" >
  <link href="{{ asset('canvas/css/canvas.css') }}" rel="stylesheet" >
  <link href="{{ asset('canvas/css/custom.css') }}" rel="stylesheet">

  <!-- Load styles from child views -->
  @stack('styles')

  <script src="{{ asset('canvas/js/jquery.min.js') }}"></script>
  <script src="{{ asset('canvas/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('canvas/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('canvas/js/datatables.min.js') }}"></script>
  <script src="{{ asset('canvas/js/buttons.server-side.js') }}"></script>
  <script src="{{ asset('canvas/js/tagsinput.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <form class="form-inline ml-3" action="{{ route('admin.search') }}" method="POST">
      @csrf
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" name="query" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="/admin/account" aria-expanded="false">
          <img src="{{Auth::user()->photo}}" alt="user" class="rounded-circle" width="30">
          <span class="ml-2 font-medium">{{Auth::user()->name}}</span>
          <span class="fas fa-angle-down ml-2"></span>
        </a>
        
        <div class="dropdown-menu dropdown-menu-right">
          <a href="/admin/account" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> My Account
          </a>
          <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt mr-2"></i> Log out
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="{{ asset('canvas/img/canvas-c.png')}}" alt="Canvas Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Canvas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{Auth::user()->photo}}" class="img-circle elevation-2" alt="{{Auth::user()->name}}">
        </div>
        <div class="info">
          <a href="/admin/account" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      @include('canvas::admin.nav')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="app">
    <!-- Content Header (Page header) -->
    <div class="content-header p-3">
        <!-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div> -->
        @if(flash()->message)
            <div class="alert {{ flash()->class }}">
                {{ flash()->message }}
            </div>
        @endif
          <div class="row justify-content-center">
              <div class="col-md-12">
                @if (count($errors) > 0)
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" id="formMessage" role="alert">
                      {{ $error }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endforeach
                @endif
              @yield('content')
              </div>
          </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong><a href="https://github.com/seongbae/canvas" target="_blank">Canvas Admin Panel</a></strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> {{option('version')}}
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



 @stack('scripts')
</body>
</html>
