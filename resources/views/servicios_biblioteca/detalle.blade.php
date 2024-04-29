@extends('layouts.administrador')

@section('content')
 <input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
             Detalles del Servicio de Archivo y Biblioteca de :
            </h1>
                  @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo '<h5>'. $data['nombre_subservicio']."</h5>"  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo '<h5>'. $data['nombre_subservicio_ingles']."</h5>"  ?>  
                   @endif
                 @endforeach  
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
              <li class="breadcrumb-item active"><a href="{{url('/servicios_biblioteca')}}">{!! trans('messages.serviciobiblioteca') !!}</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-check"></i>
                  @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo $data['nombre_subservicio'];  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo $data['nombre_subservicio_ingles'];  ?>  
                   @endif
                 @endforeach 
            </h3>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-banner-tab" data-toggle="pill" href="#custom-content-below-banner" role="tab" aria-controls="custom-content-below-banner" aria-selected="true">Banner</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Contenido</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Infografías</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Parallax</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
       <section class="content">
              <!-- tab 1 banner -->
              <div class="tab-pane fade show active" id="custom-content-below-banner" role="tabpanel" aria-labelledby="custom-content-below-banner-tab">
                <section class="content">
                  <?php if (count($detalle_subservicio) > 0) : ?>
                    <?php foreach ($detalle_subservicio as $bnr) : ?>
                      <!-- Default box -->
                      <div class="card card-solid">
                        <div class="card-body pb-0">
                          <div class="row">
                            <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
                              <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                  Banner
                                </div>
                                <div class="card-body pt-0">
                                  <div class="row">
                                    <div class="col-12">
                                      <img src="<?php echo env('APP_ADMIN') . "" . $bnr['banner']; ?>" onerror="this.src='<?php echo asset('archivos/banner_detalleservicio/img.png'); ?>'" class="imgpreview" width="100%">
                                    </div>
                                  </div>
                                </div>
                                <div class="card-footer">
                                  <div class="text-right">
                                    <button class="btn btn-sm btn-info" onclick="formulariobanner(<?php echo $bnr['id']; ?>)"><i class="fa fa-edit"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    <?php endforeach; ?>
                    <?php else : ?>
                    <div class="card-header">
                        <div class="card-tools">
                            <button class="btn btn-sm btn-info" id="btnNuevo"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                        </div>
                    </div>
                 <?php endif; ?>
                </section>
              </div>
              <!-- tab 1 banner -->

            </section>


              </div>

            </div>

          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
  <div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                 @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo $data['nombre_subservicio'];  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo $data['nombre_subservicio_ingles'];  ?>  
                   @endif
                 @endforeach 

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-content"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var subservicio_id = '<?php echo $subservicio_id; ?>';  
    $(document).ready(function() {

        $('#maintable').DataTable();

        $('#btnNuevo').click(function() {
            formulariobanner();
        });
        $('#btnNuevo1').click(function() {
            formulario1();
        });
    });
/*************** Contenido del servicio ***********************/
    function formulariobanner(id = null) {
        $.ajax({
            url: '<?php echo url('/bnnr_subserviciosbbt') ?>',
            type: 'POST',
            data: {
                id: id,
                subservicio_id: subservicio_id
            },
            beforeSend: function() {
                $('#modal-nuevo').modal('show');
                $('#form-content').html("Cargando <i class='fa fa-spinner fa-pulse'></i>");
            },
            success: function(view) {
                $('#form-content').html(view);
            },
            error: function() {
                $('#form-content').html("Error al cargar ventana.");
            }
        });
    }
/*************** Contenido del servicio ***********************/
/*************** Contenido del servicio card de detalle ***********************/
     function formulario1(id = null) {
        $.ajax({
            url: '<?php echo url('/servicio_card_detalle') ?>',
            type: 'POST',
            data: {
                id: id,
                subservicio_id: subservicio_id
            },
            beforeSend: function() {
                $('#modal-nuevo1').modal('show');
                $('#form-content1').html("Cargando <i class='fa fa-spinner fa-pulse'></i>");
            },
            success: function(view) {
                $('#form-content1').html(view);
            },
            error: function() {
                $('#form-content1').html("Error al cargar ventana.");
            }
        });
    } 
       function eliminar_procesos(id = null) {

        swal({
            title: '¿Seguro desea eliminar el registro seleccionado?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: '¡Eliminar!',
            confirmButtonColor: '#dd3333',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo url('/eliminarprocesos') ?>',
                    type: 'POST',
                    data: {
                        id: id,

                    },
                    beforeSend: function() {

                    },
                    success: function(data) {

                        if (typeof data.errorMessage != 'undefined') {
                            swal({
                                icon: 'error',
                                text: data.errorMessage,
                                showConfirmButton: true
                            });
                            return false;
                        }

                        swal({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: 'El registro ha sido eliminado.',
                            showConfirmButton: true,
                            timer: 1500
                        }).then(function(result) {
                            location.reload();
                        });
                    },
                    error: function() {

                    }
                });
            }
        })

    }

</script>
@endsection
