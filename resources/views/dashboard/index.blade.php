@extends('layouts.administrador')

@section('content')
@if (Session::has("error"))
<script>
    notie.alert({
        type: 3,
        text: '¡Accedo denegado!',
        time: 10
    })
</script>
@endif
<!-- Content Header (Page header) -->
<?php $administradores = App\Administradores::all(); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Escritorio</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Escritorio</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Redactores</span>
                <span class="info-box-number">
                 {{count($listredactores)}}
                  <small>Usuarios</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
                    <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1" ><i class="fas fa-users" style="color: #fff;"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" >Jefes Redacción / Información</span>
                <span class="info-box-number">{{count($listprensa)}} <small>Usuarios</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon elevation-1" style="background-color: #6610f2; color: #fff;"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Correctores</span>
                <span class="info-box-number">{{count($listcorrectores)}} <small>Usuarios</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Administradores</span>
                <span class="info-box-number">{{count($listadmin)}} <small>Usuarios</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Lista de usuarios conectados</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-responsive-lg">
                    <thead>
                        <tr>
                            <th style="font-size: 12px;">Foto</th>
                            <th style="font-size: 12px; width: 25%;">Nombre</th>
                            <th style="font-size: 12px;">Télefono Principal</th>
                            <th style="font-size: 12px;">Ult. vez conectado</th>
                            <th style="font-size: 12px;">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <img onclick="$('#foto').trigger('click');" src="<?php echo !empty($user['foto']) ? url('/') . $user['foto'] : asset('images/icons/default-image.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 30px;height: 30px;" class="rounded-circle">
                                </td>
                                <td style="font-size: 12px;">{{ $user->name }}</td>
                                <td style="font-size: 12px;">
                                    <?php if($user->telefono != ''){?>
                                        <a href='https://api.whatsapp.com/send?phone={{ $user->telefono }}&text=Hola!%20te%20contacto%20mediante%20GESTOR%20GUACAMAYA%20para%20aclarar%20dudas%20referente%20a%20una%20publicación' target="_blank" data-toggle="tooltip" data-placement="top" title="Clic para contactar vía Whatsapp Web a {{ $user->name }}" class="btn btn-outline-info btn-sm">Puedes Contactar por <i class="fab fa-whatsapp" ></i></a>
                                  
                                     <?php  } ?>
                                   </td>
                                <td style="font-size: 12px;">
                                    {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                </td>
                                <td style="font-size: 12px;">
                                    @if(Cache::has('user-is-online-' . $user->id))
                                        <span class="text-success"><i class="fas fa-circle"></i> En línea</span>
                                    @else
                                        <span class="text-danger"> <i class="fas fa-circle"></i> Desconectado</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Estadísticas Mensuales Página Web</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th style="font-size: 12px;">Informe</th>
                    <th style="font-size: 12px;">Fecha</th>
                    <th style="font-size: 12px;">Descarga</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td style="font-size: 12px;">
                      Informe General de Visitas y Clics
                    </td>
                    <td style="font-size: 12px;">22/09/2022</td>
                    <td style="text-align: center; width: 5%;">
                    <?php if (in_array(auth()->user()->rol, array('A'))) : ?>  
                    <a href="{{asset('archivos/informes/informe_septiembre2022.pdf')}}"><i class="fas fa-download" title="Descargar Informe"></i></a>
                    <?php else: ?>
                        <span style=" font-weight: 600; font-size: 12px;"><i class="fas fa-exclamation-triangle" style="color: #ff8100;"></i> No eres administrador</span>
                    <?php endif; ?>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size: 12px;">
                      Informe General de Visitas y Clics
                    </td>
                    <td style="font-size: 12px;">01/03/2023</td>
                    <td style="text-align: center; width: 5%;">
                    <?php if (in_array(auth()->user()->rol, array('A'))) : ?>  
                    <a href="{{asset('archivos/informes/informe_febrero2023.pdf')}}"><i class="fas fa-download" title="Descargar Informe"></i></a>
                    <?php else: ?>
                        <span style=" font-weight: 600; font-size: 12px;"><i class="fas fa-exclamation-triangle" style="color: #ff8100;"></i> No eres administrador</span>
                    <?php endif; ?>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Estadísticas Totales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="myChart" style="width:100%;max-width:700px"></canvas>

              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Estadísticas por Estado de la Nota</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>

              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->

        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Publicaciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                                    <table border="0" cellspacing="5" cellpadding="5">
                            <tbody><tr>
                                <td>Fecha Anterior:</td>
                                <td><input type="text" id="min" name="min"></td>
                            </tr>
                            <tr>
                                <td>Fecha Actual:</td>
                                <td><input type="text" id="max" name="max"></td>
                            </tr>
                        </tbody></table>


                <table class="table table-responsive-lg" id="maintable">
                  <thead>
                  <tr>
                    <th style="font-size: 12px;">ID</th>
                    <th style="font-size: 12px;">Titúlo</th>
                    <th style="font-size: 12px;">Categoría</th>
                    <th style="font-size: 12px; width: 25%;">Nombre y Apellido</th>
                    <th style="font-size: 12px; width: 10%;">Rol</th>
                    <th style="font-size: 12px;">Creado</th>
                    <th style="font-size: 12px;">Estado</th>
                  </tr>
                  </thead>
                  <tbody>
                        @foreach($trabajador as $trabajador)
                            <tr>
                                <td style="font-size: 12px;">{{ $trabajador->id }}</td>
                                <td style="font-size: 12px;">{{ $trabajador->nombre }}</td>
                                <td style="font-size: 12px;">{{ $trabajador->categoriades }}</td>
                                <td>{{ $trabajador->creador }}</td>
                                <td>
                                      <?php
                                        switch ($trabajador['rol']) {
                                            case 'A':
                                              echo "<span class='badge bg-warning'>Administrador</span>";
                                            break;
                                            case 'B':
                                             echo "<span class='badge bg-warning'>Voces</span>";
                                            break;
                                            case 'C':
                                             echo "<span class='badge bg-warning'>Redactor</span>";
                                            break;
                                            case 'D':
                                             echo "<span class='badge bg-warning'>Corrector</span>";
                                            break;
                                            case 'E':
                                             echo "<span class='badge bg-warning'>Jefe Redacción / Información</span>";
                                            break;
                                            default:
                                               echo "----";
                                            break;
                                            }
                                        ?>
                                </td>
                                <td style="font-size: 12px;">{{ $trabajador->created_at }}</td>
                                                                            <td><?php
                                                switch ($trabajador['estado']) {
                                                    case 'A':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E' || auth()->user()->rol == 'V') {
                                                            echo "<span class='right badge badge-success' style='font-size:14px; color: #fff'>Publicada</span>";
                                                            break;
                                                        }
                                                    case 'I':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E' || auth()->user()->rol == 'V') {
                                                            echo "<span class='right badge badge-warning' style='font-size:14px; color: #fff'>Borrador</span>";
                                                            break;
                                                        }
                                                    case 'R':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E' || auth()->user()->rol == 'V') {
                                                            echo "<span class='right badge badge-info' style='background-color:#9917b8!important; font-size:14px; color: #fff'>Para Corrección</span>";
                                                            break;
                                                        }
                                                    case 'P':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E' || auth()->user()->rol == 'V') {
                                                            echo "<span class='right badge badge-primary' style='background-color:#007bff!important; font-size:14px; color: #fff'>Publicada</span>";
                                                            break;
                                                        }
                                                        case 'Z':
                                                            if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E' || auth()->user()->rol == 'V') {
                                                                echo "<span class='right badge badge-info' style='background-color:#9917b8!important; font-size:14px; color: #fff'>Para Corrección Voces</span>";
                                                                break;
                                                            }
                                                    case 'Q':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E' || auth()->user()->rol == 'V') {
                                                            echo "<span class='right badge badge-info' style='background-color:#d34915f2 !important; font-size:14px; color: #fff'>Para Publicar-Voces</span>";
                                                            break;
                                                        }
                                                            
                                                    default:
                                                        echo "----";
                                                        break;
                                                }
                                                ?>
                                            </td>
                            </tr>
                        @endforeach
                
                  </tbody>
                </table>
              </div>

              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->


        </div>

    </div><!-- /.container-fluid -->

</section>
    <!-- Main content -->
<script>
   var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[5] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
    
    $(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'YYYY-MM-DD'
    });
    maxDate = new DateTime($('#max'), {
        format: 'YYYY-MM-DD'
    });
   var table = $('#maintable').DataTable({
            
            order: [
                [6, 'desc']
            ]
        });
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });


    });

</script>

@endsection