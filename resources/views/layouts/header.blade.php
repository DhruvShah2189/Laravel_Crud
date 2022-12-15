{{-- <nav class="main-header navbar navbar-expand navbar-black navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link user-nav-link" data-toggle="dropdown" href="#">
          <div class="user-panel user-image pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('/') }}img/user8-128x128.jpg" alt="{{ Auth::user()->name }}"
                width="50px" height="50px" class="img-circle elevation-2" alt="User Image">
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-sm user-settings dropdown-menu-right">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                       this.closest('form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              {{ __('Logout') }}
            </a>
          </form>
        </div>
      </li>
    </ul>
  </nav> --}}


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
      <!-- Navbar Search -->
      <li class="nav-item dropdown">
        <a class="nav-link user-nav-link" data-toggle="dropdown" href="#">
          <div class="user-panel user-image pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset('/') }}img/user8-128x128.jpg" alt="{{ Auth::user()->name }}"
                width="50px" height="50px" class="img-circle elevation-2" alt="User Image">
            </div>
          </div>
        </a>
        <div class="dropdown-menu user-settings dropdown-menu-right">
          <form method="POST" action="{{ route('logout') }}" class="mb-0">
            @csrf
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                       this.closest('form').submit();">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              {{ __('Logout') }}
            </a>
          </form>
        </div>
      </li>
      <!-- Messages Dropdown Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
  <!-- /.navbar -->
