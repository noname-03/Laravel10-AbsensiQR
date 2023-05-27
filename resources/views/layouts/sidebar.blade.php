<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        {{-- <img src="{{ asset('admin/dist/images/logo-lam-kprs.png') }}" alt="AdminLTE Logo" style="width:200px"> --}}
        {{-- <img src="{{ asset('admin/dist/images/logo-lam-kprs.png') }}" alt="AdminLTE Logo" class="brand-image"
            style="width: 20"> --}}
        <span class="brand-text font-weight-light">Inserd</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a class="d-block">{{ Auth::User()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link @yield('dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item @yield('data')">
                    <a href="#" class="nav-link @yield('nav')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        {{-- user --}}
                        <li class="nav-item">
                            <a href="{{route('user.index')}}" class="nav-link @yield('user')">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-bars nav-icon"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @yield('notif')">
                    <a href="#" class="nav-link @yield('nav')">
                        <i class="nav-icon fa fa-bullhorn" aria-hidden="true"></i>
                        <p>
                            Notifikasi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link @yield('category')">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-th-large nav-icon" aria-hidden="true"></i>
                                <p>Kategori Notifikasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link @yield('index')">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-bars nav-icon"></i>
                                <p>Data Notification</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>