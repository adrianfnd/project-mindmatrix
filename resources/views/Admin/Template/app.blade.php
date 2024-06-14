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
    @include('admin.Template.navbar')
    @include('admin.Template.slidebar_left')
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
  <script>
    $(document).ready(function () {
      // Check if the current URL path matches the specified patterns
      var path = window.location.pathname;
      if (path === '/admin') {
        $('#dashboard').addClass('active');
      }
      // Check if the URL matches 'admin/user*' or 'admin/Role*'
      if (path.startsWith('/admin/') && (path.includes('/user') || path.includes('/Role'))) {
        $('.nav-item').each(function () {
          var linkPath = $(this).find('a').attr('href');
          if (linkPath && (path.startsWith('/admin/user') && linkPath.includes('/admin/user')) ||
            (path.startsWith('/admin/Role') && linkPath.includes('admin/Role')) ||
            linkPath === '#setting_website') {
              console.log(this);
            $(this).addClass('menu-open').find('a').first().addClass('active');
          }
        });
      }
        if (path === '/admin/minat_bakat/setting_page' || path === '/admin/minat_bakat/setting_page/create') {
          $('.nav-item').each(function () {
            var linkPath = $(this).find('a').attr('href');
            if (linkPath && (linkPath.includes('/admin/minat_bakat/setting_page') || linkPath === '#minat_bakat') ) {
              $(this).addClass('menu-open').find('a').first().addClass('active');
            }
          });
        }

        // Check if the URL starts with '/admin/minat_bakat' (handles query string)
        if (path === '/admin/minat_bakat') {
          $('.nav-item').each(function () {
            var linkPath = $(this).find('a').attr('href');
            if (linkPath && (linkPath.includes('/admin/minat_bakat?l') || linkPath === '#minat_bakat')) {
              $(this).addClass('menu-open').find('a').first().addClass('active');
            }
          });
        }
    });
  </script>
  @yield('script')

</body>

</html>