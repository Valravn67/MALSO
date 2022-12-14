<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>MALSO | @yield('title')</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}"/>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.css') }}" />
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />

    @yield('css')

    @if (Session::has('alerts'))
    <link rel="stylesheet" href="{{ asset('/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/toastr/toastr.min.css') }}">
    @endif
  </head>

  <body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #850000">
        <!-- Brand Logo -->
        <div class="brand-link">
          <img src="/dist/img/malsow.png" alt="telkomakses-logo" class="brand-text" style="width: 234px "/>
          {{-- <span class="brand-text font-weight-light" style="color: azure">.</span> --}}
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex" >
            <div class="image">
              <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2"/>
            </div>
            <div class="info">
              <div class="d-block" style="color: azure">{{ session('auth')->username }}</div>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item has-treeview">
                <a href="javascript:void(0)" class="nav-link" style="color: azure">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                    Input Data
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/logistics/stock_material" class="nav-link" style="color: azure">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Stock Materials</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/logistics/out_material" class="nav-link" style="color: azure">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Out Materials</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="javascript:void(0)" class="nav-link" style="color: azure">
                  <i class="nav-icon fas fa-warehouse" ></i>
                  <p>
                    Report
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/report/stock_material" class="nav-link" style="color: azure">
                      <i class="far fa-circle nav-icon" ></i>
                      <p>Stock Materials</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/report/out_material" class="nav-link" style="color: azure">
                      <i class="far fa-circle nav-icon" ></i>
                      <p>Out Materials</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="javascript:void(0)" class="nav-link" style="color: azure">
                  <i class="nav-icon fas fa-user" ></i>
                  <p>
                    Super Admin
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/admin/warehouse_staff_list" class="nav-link" style="color: azure">
                      <i class="far fa-circle nav-icon" ></i>
                      <p>Warehouse Staff List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin/technician_list" class="nav-link" style="color: azure">
                      <i class="far fa-circle nav-icon" ></i>
                      <p>Technician List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                    <a href="/logout" class="nav-link" style="color: azure; ">
                      <i class="fas fa-sign-out-alt nav-icon"></i>
                      <p>Logout</p>
                    </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>@yield('title')</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item">{{ Request::segment(1) }}</li>
                  <li class="breadcrumb-item active">{{ Request::segment(2) }}</li>
                </ol>
              </div>
            </div>
          </div>
        </section>
        <section class="content">
          <div class="container-fluid">
        @yield('content')
          </div>
        </section>
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="float-right d-none d-sm-block"><b>Version</b> 1.0.x</div>
        <strong>Copyright &copy; {{ date('Y') }} Monitoring Access Logistics SO | POLIBAN.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/dist/js/demo.js') }}"></script>
    <!-- page script -->
    @if (Session::has('alerts'))
    <script src="{{ asset('/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>
      @foreach(Session::get('alerts') as $alert)
      <script>
          $(function() {
            var message = {!! json_encode($alert) !!}
              var Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000
              });
              Toast.fire({
                icon: message['type'],
                title: message['text']
              })
          });
      </script>
      @endforeach
    @endif
    @yield('js')
  </body>
</html>
