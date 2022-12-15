{{-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('category.index') }}" class="brand-link">
      <img src="{{ asset('/') }}img/AdminLTELogo.png" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Lara App</span>
    </a>


    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ Route::is('category.index') ? 'active' : '' }}" class="nav-link">

                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ Route::is('products.index') ? 'active' : '' }}" class="nav-link">

                        <p>Products</p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside> --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        {{-- <img src="{{ asset('/') }}img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">Lara App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" class="nav-link">

                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ Route::is('category.*') ? 'active' : '' }}" class="nav-link">

                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ Route::is('products.*') ? 'active' : '' }}" class="nav-link">

                        <p>Products</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
