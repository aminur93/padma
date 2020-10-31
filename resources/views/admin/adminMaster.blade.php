<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PadmaTechnology | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper" id="app">

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
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user"></i> Progile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-cogs"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Padma Technology</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidefrontenduser panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/admin/dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <router-link to="/home" class="nav-link" exact>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </router-link>
                    </li>


                    <li class="nav-item has-treeview">
                        <router-link to="/home/category" class="nav-link" exact>
                            <i class="nav-icon fas fa-list"></i>
                            <p>Category</p>
                        </router-link>
                    </li>

                    <li class="nav-item has-treeview">
                        <router-link to="/home/sub_categories" class="nav-link" exact>
                            <i class="nav-icon fa fa-list-alt"></i>
                            <p>Sub Category</p>
                        </router-link>
                    </li>

                    <li class="nav-item has-treeview">
                        <router-link to="/home/tag" class="nav-link" exact>
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Tag</p>
                        </router-link>
                    </li>

                    <li class="nav-item has-treeview">
                        <router-link to="/home/blog_post" class="nav-link" exact>
                            <i class="nav-icon fas fa-bacon"></i>
                            <p>Blog Post</p>
                        </router-link>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                User Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link to="/home/user" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users</p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/home/role" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/home/permission" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <admin-main></admin-main>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer" style="min-height: 0">
        <strong>Copyright &copy; 2014-2020 <a href="">AminurDev.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.5
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
