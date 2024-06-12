<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <!-- Alamat belum di setting -->
  <a href="#" class="brand-link">
    <img src="{{asset('asset/img_adminlte/adminLTELogo.png')}}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Item -->
          <li class="nav-item ">
            <a href="{{route('admin.dashboard') }}" class="nav-link" id="dashboard">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="#minat_bakat" class="nav-link">
              <i class="nav-icon fa fa-solid fa-person-hiking"></i>
              <p>
                Minat Bakat
              </p>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.minat.dashboard',['limit_per_page' => '10'])}}" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>
                  <p>User Test</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.minat.setting.dashboard')}}" class="nav-link">
                  <i class="fa fa-tasks nav-icon"></i>
                  <p>Setting Page</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#setting_website" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting Website
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.user.dashboard',['limit_per_page' => 10])}}" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.role.dashboard',['limit_per_page' => 10])}}" class="nav-link">
                  <i class="fa fa-tasks nav-icon"></i>
                  <p>Role</p>
                </a>
              </li>
            </ul>
          </li>

        <!-- Untuk Admin Setting -->

        <!-- End item -->
      </ul>
    </nav>

  </div>
</aside>



