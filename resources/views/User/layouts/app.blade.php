<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <script src="https://kit.fontawesome.com/c7442c23c6.js" crossorigin="anonymous"></script>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('/asset/css/adminlte/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('/asset/css/adminlte/all.min.css')}}">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar dan side bar -->
    @include('User.layouts.navbar')
    @include('User.layouts.slidebar_left')
    <!-- Header Content-->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield('title')</h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            @yield('content')
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div>
      </div>
    </div>
    <!-- Main Footer -->
    <footer class="main-footer">
      @include('Admin.Template.footer')
    </footer>
  </div>
  <script src="{{asset('asset/js/adminlte/jquery/jquery.js')}}"></script>
  <script src="{{asset('asset/js/adminlte/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('asset/js/adminlte/js/adminlte.js')}}"></script>
  @yield('script')
</body>

</html>