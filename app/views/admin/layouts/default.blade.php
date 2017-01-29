<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    {{ HTML::style("admin/bootstrap/css/bootstrap.min.css") }}
    <!-- Font Awesome -->
    <!-- Ionicons -->
    <!-- Theme style -->
    {{ HTML::style("admin/dist/css/AdminLTE.min.css") }}
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {{ HTML::style("admin/dist/css/skins/_all-skins.min.css") }}
    <!-- iCheck -->
    {{ HTML::style("admin/plugins/iCheck/flat/blue.css") }}
    <!-- Morris chart -->
    {{ HTML::style("admin/plugins/morris/morris.css") }}
    <!-- jvectormap -->
    {{ HTML::style("admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}
    <!-- Date Picker -->
    {{ HTML::style("admin/plugins/datepicker/datepicker3.css") }}
    <!-- Daterange picker -->
    {{ HTML::style("admin/plugins/daterangepicker/daterangepicker-bs3.css") }}
    <!-- bootstrap wysihtml5 - text editor -->
    {{ HTML::style("admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") }}
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fullcalendar/fullcalendar.print.css') }}" media="print">

    {{ HTML::style('admin/custom-admin.css') }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    
    <input type="hidden" class="baseUrl" value="{{ URL::to('/') }}">
    <div class="wrapper">
      @if(Auth::check())
      <header class="main-header">
        <!-- Logo -->
        <a href="{{ URL::to('administrador') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning notification-amount"></span>
                </a>
                <ul class="dropdown-menu notifications-menu">
                  <li class="header">No tienes notificaciones nuevas.</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                       
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('images/avatars/'.Auth::user()->avatar) }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name.' '.Auth::user()->lastname }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('images/avatars/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
                    <p>
                      {{ Auth::user()->name.' '.Auth::user()->lastname }}
                      <small>Miembro desde {{ date('d-m-Y',strtotime(Auth::user()->created_at)) }}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ URL::to('administrador/usuario/perfil') }}" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ URL::to('administrador/logout') }}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
     
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('images/avatars/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name.' '.Auth::user()->lastname }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active ">
              <a href="{{ URL::to('administrador') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
            </li>
            @if(Auth::user()->role_id == 3)
              @if(ShopType::getShopInfo()->store_plan > 1)
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Editar tienda</span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ URL::to('administrador/tienda/agregar-logo') }}"><i class="fa fa-circle-o"></i> Agregar / Cambiar logo</a></li>
                    <li><a href="{{ URL::to('administrador/tienda/editar-colores') }}"><i class="fa fa-circle-o"></i> Editar colores</a></li>
                    <li><a href="{{ URL::to('administrador/tienda/editar-banner') }}"><i class="fa fa-circle-o"></i> Editar Banner Principal</a></li>
                  </ul>
                </li>
              @endif
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuario</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/usuario/nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo Usuario</a></li>
                <li><a href="{{ URL::to('administrador/ver-usuarios') }}"><i class="fa fa-circle-o"></i> Ver Usuarios</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i>
                <span>Categorias</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/categorias/nueva') }}"><i class="fa fa-circle-o"></i> Nueva categoria</a></li>
                <li><a href="{{ URL::to('administrador/categorias/ver-categorias') }}"><i class="fa fa-circle-o"></i> Ver categorias</a></li>
                <li><a href="{{ URL::to('administrador/sub-categorias/nueva') }}"><i class="fa fa-circle-o"></i> Nueva sub-categoria</a></li>
                <li><a href="{{ URL::to('administrador/categorias/ver-sub-categorias') }}"><i class="fa fa-circle-o"></i> Ver sub-categorias</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                <span>Tienda</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/nuevo-producto') }}"><i class="fa fa-circle-o"></i> Nuevo Producto</a></li>
                <li><a href="{{ URL::to('administrador/ver-productos') }}"><i class="fa fa-circle-o"></i> Ver Productos</a></li>
                <li><a href="{{ URL::to('administrador/nueva-marca') }}"><i class="fa fa-circle-o"></i> Nueva Marca</a></li>
                <li><a href="{{ URL::to('administrador/ver-marcas') }}"><i class="fa fa-circle-o"></i> Ver Marcas</a></li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tags"></i>
                <span>Ofertas</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/nueva-oferta') }}"><i class="fa fa-circle-o"></i> Nueva Oferta</a></li>
                <li><a href="{{ URL::to('administrador/ver-ofertas') }}"><i class="fa fa-circle-o"></i> Ver Ofertas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-ticket"></i>
                <span>Pagos</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/ver-pagos') }}"><i class="fa fa-money"></i> Ver pagos</a></li>
              </ul>
            </li>
            @else
            <li class="treeview">
              <a href="#">
                <i class="fa fa-ticket"></i>
                <span>Tickets</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ URL::to('administrador/tickets/nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo ticket</a></li>
              </ul>
            </li>
            
            @endif
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
       @endif
      <!-- Content Wrapper. Contains page content -->
      
        
        @yield('content')
      <footer class="main-footer @if(!Auth::check()) no-auth @endif">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane active" id="control-sidebar-settings-tab">
            
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    {{ HTML::script("admin/plugins/jQuery/jQuery-2.1.4.min.js") }}

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    {{ HTML::script("admin/bootstrap/js/bootstrap.min.js") }}
    <!-- Morris.js charts -->
    {{ HTML::script("admin/plugins/morris/morris.min.js") }}
    <!-- Sparkline -->
    {{ HTML::script("admin/plugins/sparkline/jquery.sparkline.min.js") }}
    <!-- jvectormap -->
    {{ HTML::script("admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js") }}
    {{ HTML::script("admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js") }}
    <!-- jQuery Knob Chart -->
    {{ HTML::script("admin/plugins/knob/jquery.knob.js") }}
    <!-- daterangepicker -->
    {{ HTML::script("admin/plugins/daterangepicker/daterangepicker.js") }}
    <!-- datepicker -->
    {{ HTML::script("admin/plugins/datepicker/bootstrap-datepicker.js") }}
    <!-- Bootstrap WYSIHTML5 -->
    {{ HTML::script("admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}
    <!-- Slimscroll -->
    {{ HTML::script("admin/plugins/slimScroll/jquery.slimscroll.min.js") }}
    <!-- FastClick -->
    {{ HTML::script("admin/plugins/fastclick/fastclick.min.js") }}
    <!-- AdminLTE App -->
    {{ HTML::script("admin/dist/js/app.min.js") }}
    <!-- fullCalendar 2.2.5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('admin/plugins/fullcalendar/fullcalendar.min.js') }}"></script>

    {{ HTML::script('admin/custom-admin.js') }}
    @yield('postscript')
  </body>
</html>
