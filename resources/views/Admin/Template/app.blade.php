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
      var path = window.location.pathname;

      // Function to add active and menu-open classes
      function activateNavItem(pathPatterns, menuId) {
        $('.nav-item').each(function () {
          var linkPath = $(this).find('a').attr('href');
          if (pathPatterns.some(pattern => path.startsWith(pattern) || linkPath.includes(pattern))) {
            $(this).addClass('menu-open').find('a').first().addClass('active');
          }
        });
      }

      // Determine which menu to activate based on the path
      switch (path) {
        case '/admin':
          $('#dashboard').addClass('active');
          break;
        case '/admin/minat_bakat/setting_page':
          activateNavItem(['/admin/minat_bakat/setting_page?l', '#minat_bakat']);
          break;
        case '/admin/minat_bakat/setting_page/create':
          activateNavItem(['/admin/minat_bakat/setting_page/create?l', '#minat_bakat']);
          break;
        case '/admin/minat_bakat':
          activateNavItem(['/admin/minat_bakat?l', '#minat_bakat']);
          break;
        case '/admin/univeritas/jurusan':
          activateNavItem(['/admin/univeritas/jurusan?l', '#univeritas']);
          break;
        case '/admin/univeritas':
          activateNavItem(['/admin/univeritas?l', '#univeritas']);
          break;
        case '/admin/user':
          activateNavItem(['/admin/user?l', '#setting_website'], '');
          break;
        case '/admin/Role':
          activateNavItem(['/admin/Role?l', '#setting_website'], '');
          break;
        default:
          activateNavItem(['/admin/user?l', '#setting_website'], '');
          break;
      }
    });

  </script>
  @yield('script')

</body>

</html>