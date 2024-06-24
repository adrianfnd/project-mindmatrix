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
            <a href="{{route('user.dashboard') }}" class="nav-link" id="dashboard">
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
            </a>
          </li>
        <!-- Untuk Admin Setting -->

        <!-- End item -->
      </ul>
    </nav>

  </div>
</aside>



