<div class="sidebar-wrapper">
  <nav class="mt-2">
    <!--begin::Sidebar Menu-->
    <ul
      class="nav sidebar-menu flex-column"
      data-lte-toggle="treeview"
      role="navigation"
      aria-label="Main navigation"
      data-accordion="false"
      id="navigation"
    >
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
          <i class="nav-icon bi bi-palette"></i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon bi bi-box-seam-fill"></i>
          <p>
            Users
            <i class="nav-arrow bi bi-chevron-right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>All Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-circle"></i>
              <p>Create User</p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <!--end::Sidebar Menu-->
  </nav>
</div>
