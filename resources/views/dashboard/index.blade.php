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
                <h1 class="m-0">{!! trans('messages.menulateral') !!}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
                    <li class="breadcrumb-item active">{!! trans('messages.menulateral') !!}</li>
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
                <span class="info-box-text">{!! trans('messages.redactor') !!}</span>
                <span class="info-box-number">
                 {{count($listredactores)}}
                  <small>{!! trans('messages.usuarios') !!}</small>
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
                <span class="info-box-text" >{!! trans('messages.jefes') !!}</span>
                <span class="info-box-number">{{count($listprensa)}} <small>{!! trans('messages.usuarios') !!}</small></span>
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
                <span class="info-box-text">{!! trans('messages.correctores') !!}</span>
                <span class="info-box-number">{{count($listcorrectores)}} <small>{!! trans('messages.usuarios') !!}</small></span>
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
                <span class="info-box-text">{!! trans('messages.administrador') !!}</span>
                <span class="info-box-number">{{count($listadmin)}} <small>{!! trans('messages.usuarios') !!}</small></span>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">{!! trans('messages.listaconectados') !!}</h5>

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
                            <th style="font-size: 12px;">{!! trans('messages.foto') !!}</th>
                            <th style="font-size: 12px; width: 25%;">{!! trans('messages.nombre') !!}</th>
                            <th style="font-size: 12px;">{!! trans('messages.telefono') !!}</th>
                            <th style="font-size: 12px;">{!! trans('messages.ultimavezconectado') !!}</th>
                            <th style="font-size: 12px;">{!! trans('messages.estado') !!}</th>
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
                                        <a href='https://api.whatsapp.com/send?phone={{ $user->telefono }}&text=Hola!%20te%20contacto%20mediante%20GESTOR%20GUACAMAYA%20para%20aclarar%20dudas%20referente%20a%20una%20publicación' target="_blank" data-toggle="tooltip" data-placement="top" title="Clic para contactar vía Whatsapp Web a {{ $user->name }}" class="btn btn-outline-info btn-sm">{!! trans('messages.contactar') !!} <i class="fab fa-whatsapp" ></i></a>
                                  
                                     <?php  } ?>
                                   </td>
                                <td style="font-size: 12px;">
                                    {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                </td>
                                <td style="font-size: 12px;">
                                    @if(Cache::has('user-is-online-' . $user->id))
                                        <span class="text-success"><i class="fas fa-circle"></i> {!! trans('messages.enlinea') !!}</span>
                                    @else
                                        <span class="text-danger"> <i class="fas fa-circle"></i> {!! trans('messages.desconectado') !!}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
              </div>
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                   {{ $users->links() }}
                </ul>
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php if (in_array(auth()->user()->rol, array('A','E'))) : ?> 
        <div class="row">
          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">{!! trans('messages.estadisticastotales') !!}</h3>

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
                <div id="piechart" style="width: 100%; height: 300px;"></div>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{!! trans('messages.estadisticasunitarias') !!}</h3>

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
                <div class="alert alert-primary" role="alert">En desarrollo</div>

              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->

        </div>

      <?php endif; ?>
    </div><!-- /.container-fluid -->
<?php echo $resultado; ?>
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
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['año', 'Hours per Day'],
          <?php echo $resultado; ?>
        ]);

        var options = {
          title: 'Publicaciones por año'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }


    </script>
    
@endsection