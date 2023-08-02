  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" style="padding: 4px 8px;" href="#" id="userDropdown"
                  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline medium">{{ Auth::user()->name }}</span>
                  <img src="{{ asset('assets/dist/img/user1.png') }}" class="img-circle elevation-2 m-0"
                      width="35px" alt="User Image">
              </a>
              <!-- Dropdown - User Information -->

              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="{{ url('logout') }}">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      {{ __('Log Out') }}
                  </a>
              </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('assets/dist/img/user1.png') }}" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  @if (Auth::user()->user_type == 1)
                      <a href="{{ url('admin/dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
                  @else
                      <a href="{{ url('user/dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
                  @endif
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  @if (Auth::user()->user_type == 1)
                      <li class="nav-item">
                          <a href="{{ url('admin/dashboard') }}"
                              class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ url('admin/users/list') }}"
                              class="nav-link @if (Request::segment(2) == 'users') active @endif">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                  Users
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ url('admin/category/list') }}"
                              class="nav-link @if (Request::segment(2) == 'category') active @endif">
                              <i class="nav-icon fas fa-list"></i>
                              <p>
                                  Category
                              </p>
                          </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{ url('admin/product/list') }}"
                              class="nav-link @if (Request::segment(2) == 'product') active @endif">
                              <i class="nav-icon fas fa-shopping-cart"></i>
                              <p>
                                  Product
                              </p>
                          </a>
                      </li>
                  @elseif(Auth::user()->user_type == 0)
                      <li class="nav-item">
                          <a href="{{ url('user/dashboard') }}"
                              class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                              <i class="nav-icon fas fa-tachometer-alt"></i>
                              <p>
                                  Dashboard
                              </p>
                          </a>
                      </li>


                      <li class="nav-item">
                          <a href="{{ url('user/product/list') }}"
                              class="nav-link @if (Request::segment(2) == 'product') active @endif">
                              <i class="nav-icon fas fa-shopping-cart"></i>
                              <p>
                                  Product
                              </p>
                          </a>
                      </li>
                  @endif


              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
