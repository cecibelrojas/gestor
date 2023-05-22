<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ env('APP_NAME','Laravel') }}</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/dist/css/fuenteoriginal.css')}}">
  <!-- Font Awesome -->
  
  <!--link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css')}}"-->
  <script src="{{asset('AdminLTE-3.2.0/dist/js/f4f739cc2f.js')}}" crossorigin="anonymous"></script>
  <!-- Ionicons -->

  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/fullcalendar/locales-all.js')}}">
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/fullcalendar/locales-all.min.js')}}">
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/fullcalendar/main.css')}}">


  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/dist/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/notie.css')}}">

  
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">    
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/datatables-select/css/select.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  


  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
  
  <link rel="stylesheet" href="{{asset('css/tagsinput.css')}}">
  <link rel="icon" type="image/png" href="{{asset('img/guacafaviccs48.ico')}}">

  <link rel="stylesheet" href="{{asset('css/general.css')}}">

  <!-- jQuery -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
    <!-- Bootstrap 4 -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

  <!-- Sparkline -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/sparklines/sparkline.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/moment/moment.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js')}}"></script>

  <!-- overlayScrollbars -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- DataTables  & Plugins -->

  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>


  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-select/js/dataTables.select.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-select/js/select.bootstrap4.min.js')}}"></script>

<!-- Select2 -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js')}}"></script>

  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.flash.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>

  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
  <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>


  <script src="{{asset('AdminLTE-3.2.0/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

  <!-- Bootstrap 4 -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <script src="{{asset('js/tagsinput.js')}}"></script>
  <script src="{{asset('js/notie.js')}}"></script>
  <script src="{{asset('js/sweetalert.js')}}"></script>

  <!-- AdminLTE App -->
  <script src="{{asset('AdminLTE-3.2.0/dist/js/adminlte.js')}}"></script>
  <script src="{{asset('js/tinymce5.js')}}"></script>

  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css')}}">
  <script src="{{asset('AdminLTE-3.2.0/dist/js/typeahead.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/dist/js/angular.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput-angular.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/dist/js/rainbow.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/dist/js/generic.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/dist/js/html.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/dist/js/javascript.js')}}"></script>



  <style>
    .swal2-title {
      font-size: 20px !important;
    }

    .swal2-content {
      font-size: 20px !important;
    }

    .main-sidebar .sidebar {
      background-color: <?php echo env('COLOR_BG_SIDEBAR') ?> !important;
      font-size: 14px;
    }

    .main-sidebar .nav-link.active {
      background-color: <?php echo env('COLOR_BG_SIDEBAR_ACTIVE') ?> !important;
      color: <?php echo env('COLOR_TEXT_SIDEBAR_ACTIVE') ?> !important;
    }

    .main-sidebar .nav-item a,
    .main-sidebar .info a {
      color: <?php echo env('COLOR_TEXT_SIDEBAR') ?> !important;
    }

    .main-sidebar .brand-link {
      background-color: <?php echo env('COLOR_BG_BRAND') ?>;
      color: <?php echo env('COLOR_TEXT_BRAND') ?>;
    }

    .main-header {
      background-color: <?php echo env('COLOR_BG_MAINHEADER') ?>;
    }

    .main-header .nav-link {
      color: <?php echo env('COLOR_TEXT_MAINHEADER') ?> !important;
    }

    #wrap {
      width: 1100px;
      margin: 0 auto;
    }


    #external-events h4 {
      font-size: 16px;
      margin-top: 0;
      padding-top: 1em;
    }

    #external-events .fc-event {
      margin: 10px 0;
      cursor: pointer;
    }

    #external-events p {
      margin: 1.5em 0;
      font-size: 11px;
      color: #666;
    }

    #external-events p input {
      margin: 0;
      vertical-align: middle;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @if (Route::has('login'))

    @auth
    <?php $administradores = App\Administradores::all(); ?>

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

        <!-- Messages Dropdown Menu -->
   <!--     <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <div class="media">
                <img src="{{asset('AdminLTE-3.2.0/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <div class="media">
                <img src="{{asset('AdminLTE-3.2.0/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <div class="media">
                <img src="{{asset('AdminLTE-3.2.0/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li> -->

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)
            <b> {{$element->name}}</b>
            @endif

            @endforeach
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Procesos del Usuario</span>
            <div class="dropdown-divider"></div>
            <a href="<?php echo url('/usuario-contrasena_individual') . "/" . auth()->user()->id; ?>" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> Cambio de Contraseña
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); desocupar_logout();">
              <i class="fas fa-sign-out-alt"></i> Salir
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
      <a  href="https://ciudadccs.info" class="brand-link" target="_blank">
        <img src="{{ asset('img/escudo2.png') }}" alt="MPPRE" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-bold">{{ env('APP_NAME','Laravel') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)

            @if ($element->foto == "")

            <img src="{{url('/')}}/vistas/img/admin.png" class="img-circle elevation-2" alt="User Image">

            @else

            <img src="{{url('/')}}/{{$element->foto}}" class="img-circle elevation-2" alt="User Image">

            @endif


            @endif

            @endforeach
          </div>
          <div class="info">
            <a href="#" class="d-block">
              @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)
              {{$element->name}}
              @endif

              @endforeach

            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ url('/') }}" class="nav-link active">
                <i class="fas fa-tachometer-alt"></i>
                <p>
                  Escritorio
                </p>
              </a>
            </li>
                @foreach ($administradores as $element)

                @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "B" || $element->rol == "C" || $element->rol == "D" || $element->rol == "E" || $element->rol == "V")

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-clipboard"></i>
                <p>
                  Redacción
                </p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/publicaciones')}}" class="nav-link">
                    <p>
                      Todas las Publicaciones
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/publicacion')}}" class="nav-link">
                    <p>
                      Nueva Publicación
                    </p>
                  </a>
                </li>
            @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)

                   @if ($element->rol == "A" || $element->rol == "E")
                <li class="nav-item">
                  <a href="{{url('/categorias')}}" class="nav-link">
                    <p>
                      Categorías
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/etiquetas') }}" class="nav-link">
                    <p>
                      Etiquetas
                    </p>
                  </a>
                </li>
              @endif

            @endif

            @endforeach

              </ul>
            </li>
                @endif

                @endif

                @endforeach




            
            @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)

            @if ($element->rol == "A")

            <li class="nav-header" style="font-size: 12px;">Configuración</li>
            <li class="nav-item">
              <a href="{{url('bancodatos')}}" class="nav-link">
                <i class="nav-icon fa-solid fa-database"></i>
                <p class="text">Banco de Datos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('widgets')}}" class="nav-link">
                <i class="nav-icon fas fa-text-width"></i>
                <p class="text">Widgets</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('usuarios')}}" class="nav-link">
                <i class="nav-icon fa-solid fa-users"></i>
                <p class="text">Usuarios</p>
              </a>
            </li>
            <li class="nav-header" style="font-size: 12px;">Toma de Decisiones</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bezier-curve"></i>
                <p class="text">Org Institucional</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p class="text">Estadisticas</p>
              </a>
            </li>
            @endif

            @endif

            @endforeach



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; {{ date('Y') }} <b>{{ env('APP_NAME')}}</b>. <img src="{{asset('img/guacafaviccs48.ico')}}" width="30px"></strong>
     Todos los derechos reservados. <strong></strong>
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/fullcalendar/main.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/dist/js/mask.js')}}"></script>
  <script src="{{asset('js/calendarioccs.js')}}"></script>

  <script src="{{asset('js/codigo.js')}}"></script>

  <script>
   $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
     })
   
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    <?php $current = url()->current(); ?>
    <?php if (url()->current() == url('publicaciones')) :  ?>
      <?php $current = url('fakepath'); ?>
    <?php endif; ?>
    /* prueba */
     <?php if (url()->current() == url('publicacion')) :  ?>
      <?php $current = url('fakepath'); ?>
    <?php endif; ?>
    /* prueba */
    
    <?php if (strpos($current, url('publicacion')) !== false) : ?>

    <?php else : ?>
      setTimeout(() => {
        $.post('<?php echo url('desocupar') ?>', function() {

        });
      }, 1000);
    <?php endif; ?>

    function desocupar_logout(id = null) {

        $.ajax({
            url: '<?php echo url("desocupar"); ?>',
            type: 'POST',
            data: {
                 id: id
                  },
            beforeSend: function() {

            },
            success: function(view) {

            },
            error: function() {

            }
        });

    }
    
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

  </script>
 <script>
var xValues = ["día", "semana", "mes", "año"];
var yValues = [55, 49, 44, 24];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Notas creadas en el sistema"
    }
  }
});

/** */

var xValues1 = ["Borrador", "Para Corrección", "Publicado"];
var yValues1 = [107, 107, 107];
var barColors1 = ["yellow", "purple","orange"];

new Chart("myChart1", {
  type: "bar",
  data: {
    labels: xValues1,
    datasets: [{
      backgroundColor: barColors1,
      data: yValues1
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Estadísticas Generales"
    }
  }
});
</script>
</body>
@else

@include('auth.login')

@endauth

@endif

</html>