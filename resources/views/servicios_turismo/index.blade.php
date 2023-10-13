@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{!! trans('messages.servicio_turismo') !!}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
                    <li class="breadcrumb-item active">{!! trans('messages.servicio_turismo') !!}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-header">
            <div class="card-tools">
                    <?php if (auth()->user()->rol == 'A' ||  auth()->user()->rol == 'E') { ?>
                        <button class="btn btn-sm btn-danger" style="background-color: #ffffff;color: #dc3545;font-weight: bold;border: 1px solid #dc3545;" onclick="location.href='<?php echo url('/papelera_turismo'); ?>'"><i class="fa fa-trash"></i> {!! trans('messages.papelera') !!}({{count($trash1)}})</button>
                    <?php  } ?>

                <button class="btn btn-sm btn-info" id="btnNuevo"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
            </div>
        </div>
        <div class="card-body pb-0">
          <div class="row">
            <?php if (count($lista) > 0) : ?>
                <?php foreach ($lista as $key) : ?>
                    <?php if ($key['papelera'] != 'P') : ?>
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-body pt-10">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>
                        @foreach (array_keys(config('locale.languages')) as $lang)
                           @if ($lang != App::getLocale() AND $lang == 'en')
                              <?php echo $key['nombre_servicio']; ?> 
                              @elseif ($lang != App::getLocale() AND $lang == 'es')
                              <?php echo $key['nombre_servicio_ingles']; ?>  
                          @endif
                       @endforeach                           

                        </b></h2>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-file-alt"></i></span> {!! trans('messages.tipo') !!}: <?php echo $key['nombre']; ?> 
                            
                        </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-check"></i>
                        </span> {!! trans('messages.estado') !!}: 
                            <?php
                                if($key['estado']=='A'){

                                     echo "<span class='right badge badge-success'> Activo </span>";

                                }else{

                                    echo "<span class='right badge badge-danger'> Inactivo </span>";
                                }
                           ?>

                    </li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="<?php echo env('APP_ADMIN') . "" . $key['icono']; ?>" class="img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="{{ url('detalles_turismo_venezuela', ['id' => $key->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-file-alt"></i> {!! trans('messages.detalle') !!}</a>
                    <button class="btn btn-sm btn-success" onclick="formulario(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="eliminar(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                    <button class="btn btn-sm btn-warning" onclick="deshabilitando(<?php echo $key['id']; ?>)"><i class="fa fa-cancel"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?> 
                <?php endforeach; ?>
                <?php else : ?>
                  <div class=" pt-40 pb-30"> 
                    <div class="alert alert-warning" role="alert">
                     <i class="fas fa-exclamation-triangle"></i> {!! trans('messages.alerta_turismo') !!}
                    </div>
                  </div> 
                <?php endif; ?> 
          </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <div class="modal fade" id="modal-nuevo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{!! trans('messages.servicio_turismo') !!}</h4>
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
<script>
    $(document).ready(function() {

        $('#maintable').DataTable();

        $('#btnNuevo').click(function() {
            formulario();
        });

    });

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/servicioturismo') ?>',
            type: 'POST',
            data: {
                id: id
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

    function eliminar(id = null) {

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
                    url: '<?php echo url('/eliminar_servicio_turismo') ?>',
                    type: 'POST',
                    data: {
                        id: id
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
        function deshabilitando(id = null) {

        swal({
            title: '¿Seguro desea mandar a la papelera el registro seleccionado?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Deshabilitar!',
            confirmButtonColor: '#dd3333',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo url('/deshabilitarservicioturismo') ?>',
                    type: 'POST',
                    data: {
                        id: id
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
                            title: '¡Deshabilitado!',
                            text: 'El registro ha sido deshabilitado.',
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