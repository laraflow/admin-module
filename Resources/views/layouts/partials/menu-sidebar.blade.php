<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('modules/admin/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 d-flex border-bottom-0">
            <div class="image">
                <img src="{{ auth()->user()->getFirstMediaUrl('avatars') }}" class="img-circle elevation-2"
                     alt="{{ auth()->user()->name }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item @if(\Route::is('admin.*')) menu-open @endif">
                    <a href="#" class="nav-link @if(\Route::is('admin.*')) active @endif ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Administration
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    @canany(['admin.users.index', 'admin.roles.index', 'admin.permissions.index'])
                        <ul class="nav nav-treeview">
                            @can('admin.users.index')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}"
                                       class="nav-link @if(\Route::is('admin.users.*')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users</p>
                                    </a>
                                </li>
                            @endcan
                            @can('admin.roles.index')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                       class="nav-link  @if(\Route::is('admin.roles.*')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                            @endcan
                            @can('admin.permissions.index')
                                <li class="nav-item">
                                    <a href="{{ route('admin.permissions.index') }}"
                                       class="nav-link  @if(\Route::is('admin.permissions.*')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Permissions</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    @endcanany
                </li>
                <li class="nav-item @if(\Route::is('system.*')) menu-open @endif">
                    <a href="#" class="nav-link @if(\Route::is('system.*')) active @endif ">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    @canany(['system.logs'])
                        <ul class="nav nav-treeview">
                            @can('system.logs')
                                <li class="nav-item">
                                    <a href="{{ route('system.logs') }}"
                                       class="nav-link @if(\Route::is('system.logs')) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Log Viewer</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    @endcanany
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.notifications.index') }}" class="nav-link  @if(\Route::is('admin.notifications.*')) active @endif">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /.main-sidebar -->
