<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

  <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/ekko-lightbox/ekko-lightbox.css')}}">

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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.css">


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
  <script src="{{asset('assets/js/Chart.js')}}"></script>

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
    <link rel="stylesheet" href="{{asset('AdminLTE-3.2.0/plugins/flag-icon-css/css/flag-icon.min.css')}}">


  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-select/js/dataTables.select.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-select/js/select.bootstrap4.min.js')}}"></script>

<!-- Select2 -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js')}}"></script>

  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

  <script src="{{asset('assets/js/moment.min.js')}}"></script>
  <script src="{{asset('assets/js/dataTables.dateTime.min.js')}}"></script>


  <script src="{{asset('AdminLTE-3.2.0/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

  <!-- Bootstrap 4 -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <script src="{{asset('js/tagsinput.js')}}"></script>
  <script src="{{asset('js/notie.js')}}"></script>
  <script src="{{asset('js/sweetalert.js')}}"></script>
<!-- Summernote -->
  <script src="{{asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js')}}"></script>
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
     <script type="text/javascript" src="{{asset('js/loader.js')}}"></script>
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
    .thumb-xxs {
    height: 24px!important;
    width: 24px!important;
    font-size: 10px;
    font-weight: 700;
}
.idioma{
    width: 36px;
    height: 36px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    border-radius: 50%;
    background-color: #f5f5f9;
    -webkit-box-shadow: none;
    box-shadow: none;
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

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          {!! trans('messages.idiomas') !!} &nbsp; 
          @foreach (array_keys(config('locale.languages')) as $lang)
            @if ($lang != App::getLocale() AND $lang == 'es')
                  <img src="{{asset('img/icon/reino-unido.png')}}" width="24px" alt="">
              @elseif ($lang != App::getLocale() AND $lang == 'en')
                <img src="{{asset('img/icon/venezuela.png')}}" alt="">
            @endif
          @endforeach
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="{{route('set_language', ['en'])}}" class="dropdown-item active">
            <img src="{{asset('img/icon/reino-unido.png')}}" width="24px" alt=""> {{ __("English") }}
          </a>
          <a href="{{route('set_language', ['es'])}}" class="dropdown-item">
            <img src="{{asset('img/icon/venezuela.png')}}" alt=""> {{ __("Spanish") }}
          </a>
        </div>
      </li>

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)
            <b> {{$element->name}}</b>
            @endif

            @endforeach
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{!! trans('messages.procesosusuarios') !!}</span>
            <div class="dropdown-divider"></div>
            <a href="<?php echo url('/usuario-contrasena_individual') . "/" . auth()->user()->id; ?>" class="dropdown-item">
              <i class="fas fa-key mr-2"></i> {!! trans('messages.cambiocontrasena') !!}
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit(); desocupar_logout();">
              <i class="fas fa-sign-out-alt"></i> {!! trans('messages.salir') !!}
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
      <a  href="https://portal.mppre.gob.ve/" class="brand-link" target="_blank">
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
                  {!! trans('messages.menulateral') !!}
                </p>
              </a>
            </li>
                @foreach ($administradores as $element)

                @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "C" || $element->rol == "D" || $element->rol == "E")

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-clipboard"></i>
                <p>
                  {!! trans('messages.redaccion') !!}
                </p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/publicaciones')}}" class="nav-link">
                    <p>
                      {!! trans('messages.todaspublicaciones') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/publicacion')}}" class="nav-link">
                    <p>
                      {!! trans('messages.nuevopost') !!}
                    </p>
                  </a>
                </li>
            @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)

                   @if ($element->rol == "A" || $element->rol == "E")
                <li class="nav-item">
                  <a href="{{url('/categorias')}}" class="nav-link">
                    <p>
                      {!! trans('messages.categorias') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ url('/etiquetas') }}" class="nav-link">
                    <p>
                      {!! trans('messages.etiquetas') !!}
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

                @if ($element->rol == "A" || $element->rol == "C" || $element->rol == "D" || $element->rol == "E")
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-image"></i>
                <p class="text">Medios</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/multimedia')}}" class="nav-link">
                    <p>
                      Lista
                    </p>
                  </a>
                </li>

              </ul>
            </li>
                @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "E" || $element->rol == "H" || $element->rol == "C" || $element->rol == "D" || $element->rol == "I")

            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.campanas') !!}</li>    
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-image"></i>
                <p class="text">{!! trans('messages.campana') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/campanasvideos')}}" class="nav-link">
                    <p>
                      {!! trans('messages.videos') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/campana_otros')}}" class="nav-link">
                    <p>
                      Videos MP4
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/campanas')}}" class="nav-link">
                    <p>
                      {!! trans('messages.imagen') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/banner_campana')}}" class="nav-link">
                    <p>
                      {!! trans('messages.bannercampanas') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li>
                @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "E" || $element->rol == "H" || $element->rol == "I")


            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.galerias') !!}</li>
            <li class="nav-item" >
              <a href="#" class="nav-link">
                <i class="fas fa-camera"></i>
                <p>
                  Galerías
                </p>
              <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/fotografias')}}" class="nav-link">
                    <p>
                      Añadir Foto
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/categoria_galerias')}}" class="nav-link">
                    <p>
                      Categoría
                    </p>
                  </a>
                </li>
              </ul>
            </li>
             @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A")

            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.coleccion') !!}</li>    
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-image"></i>
                <p class="text">{!! trans('messages.patrimonio_360') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/patrimonio360')}}" class="nav-link">
                    <p>
                      {!! trans('messages.panoramica360') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li>
                @endif

                @endif

                @endforeach

            <!--li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-edit"></i>
                <p class="text">{!! trans('messages.trabajoespecial') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <p>
                      {!! trans('messages.vertodo') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/campanas')}}" class="nav-link">
                    <p>
                      {!! trans('messages.nuevo') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li-->
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "E" || $element->rol == "F")
            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.libroscampanas') !!}</li>    
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-book"></i>
                <p class="text">{!! trans('messages.libroscampanas') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/libreria_digital')}}" class="nav-link">
                    <p>
                      {!! trans('messages.verlistas') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li>
                @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "B")

            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.servicioconsular') !!}</li>    
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-tags"></i>
                <p class="text">{!! trans('messages.serviciotramite') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/servicios')}}" class="nav-link">
                    <p>
                      {!! trans('messages.Servicios') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/ajuste_apostilla')}}" class="nav-link">
                    <p>
                      {!! trans('messages.ajustes_apostilla') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/pagos_apostilla')}}" class="nav-link">
                    <p>
                      {!! trans('messages.pagos_apostilla') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li>
                @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "F")

            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.serviciobiblioteca') !!}</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-tags"></i>
                <p class="text">{!! trans('messages.solicitudes') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/servicios_biblioteca')}}" class="nav-link">
                    <p>
                      {!! trans('messages.Servicios') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li>
                @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "E" || $element->rol == "C" || $element->rol == "D")


            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.servicioidentidad') !!}</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-tags"></i>
                <p class="text">Venezuela</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/servicios_identidad_nacional')}}" class="nav-link">
                    <p>
                      {!! trans('messages.Servicios') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.servicioturismo') !!}</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-tags"></i>
                <p class="text">{!! trans('messages.turismo') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/servicios_turismo')}}" class="nav-link">
                    <p>
                      {!! trans('messages.Servicios') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li>
                @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "E" || $element->rol == "B")


            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.geoportal') !!}</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-globe"></i>
                <p class="text">{!! trans('messages.geoportalembajada') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/embajadas')}}" class="nav-link">
                    <p>
                      {!! trans('messages.embajadas') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/consulados')}}" class="nav-link">
                    <p>
                      {!! trans('messages.consulados') !!}
                    </p>
                  </a>
                </li>

              </ul>
            </li>
                @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "E")

            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.organigramaintitucional') !!}</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-user-tag"></i>
                <p class="text">{!! trans('messages.organigrama') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/organigrama')}}" class="nav-link">
                    <p>
                      {!! trans('messages.organigrama') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/ficha')}}" class="nav-link">
                    <p>
                      {!! trans('messages.ficha') !!} 
                    </p>
                  </a>
                </li>
              </ul>
            </li>


                @endif

                @endif

                @endforeach
            @foreach ($administradores as $element)

              @if ($_COOKIE["email_login"] == $element->email)

                @if ($element->rol == "A" || $element->rol == "E" || $element->rol == "F")

           <li class="nav-header" style="font-size: 12px;">{!! trans('messages.nimiportales') !!}</li>     
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-home"></i>
                <p class="text">{!! trans('messages.nimiportales') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/casa_amarilla')}}" class="nav-link">
                    <p>
                      {!! trans('messages.casaamarilla') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/conare')}}" class="nav-link">
                    <p>
                      {!! trans('messages.conare') !!} 
                    </p>
                  </a>
                </li>
              </ul>
            </li>
                @endif

                @endif

                @endforeach

            
            @foreach ($administradores as $element)

            @if ($_COOKIE["email_login"] == $element->email)

            @if ($element->rol == "A"  || $element->rol == "E")

            <li class="nav-header" style="font-size: 12px;"> {!! trans('messages.configuracion') !!} </li>
            <li class="nav-item">
              <a href="{{url('bancodatos')}}" class="nav-link">
                <i class="fa-solid fa-database"></i>
                <p class="text">{!! trans('messages.banco') !!}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('widgets')}}" class="nav-link">
                <i class="fas fa-text-width"></i>
                <p class="text">Widgets</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('usuarios')}}" class="nav-link">
                <i class="fa-solid fa-users"></i>
                <p class="text">{!! trans('messages.usuarios') !!}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa-solid fa-gear"></i>
                <p class="text">{!! trans('messages.ajustes') !!}</p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('/redes')}}" class="nav-link">
                    <p>
                      {!! trans('messages.redes') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/logos_institucionales')}}" class="nav-link">
                    <p>
                      {!! trans('messages.imginstitucional') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/feed')}}" class="nav-link">
                    <p>
                      {!! trans('messages.feed') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/rss-generator')}}" class="nav-link">
                    <p>
                      RSS Feed
                    </p>
                  </a>
                </li>
                <!--li class="nav-item">
                  <a href="#" class="nav-link">
                    <p>
                      {!! trans('messages.bannerservicios') !!}
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <p>
                      {!! trans('messages.card') !!}
                    </p>
                  </a>
                </li -->
                <li class="nav-item">
                  <a href="{{url('/footer')}}" class="nav-link">
                    <p>
                       {!! trans('messages.Footer') !!}
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header" style="font-size: 12px;">{!! trans('messages.reportes') !!}</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-chart-pie"></i>
                <p class="text">{!! trans('messages.estadisticastotal') !!}</p>
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
     {!! trans('messages.copy') !!}. <strong></strong>
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
  <script src="{{asset('AdminLTE-3.2.0/dist/js/mask.js')}}"></script>
  <script src="{{asset('AdminLTE-3.2.0/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
  <script src="{{asset('js/calendarioccs.js')}}"></script>
  <script src="{{asset('assets/js/bootstrap-colorpicker.min.js')}}"></script>

  <!-- Fileupload JS -->
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

</body>
@else

@include('auth.login')

@endauth

@endif

</html>