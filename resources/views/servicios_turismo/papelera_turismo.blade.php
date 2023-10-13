@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{!! trans('messages.servicio_deshabilitado_turismo') !!}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/servicios_turismo'); ?>">{!! trans('messages.servicio_turismo') !!}</a></li>
                    <li class="breadcrumb-item active">{!! trans('messages.servicio_deshabilitado_turismo') !!}</li>
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
                        <h3 class="card-title">{!! trans('messages.lista_turismo_deshabilitados') !!}</h3>
                    </div>
        <div class="card-body pb-0">
          <div class="row">
            <?php if (count($trash) > 0) : ?>
                <?php foreach ($trash as $key) : ?>
            <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-body pt-10">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?php echo $key['nombre_servicio']; ?></b></h2>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-file-alt"></i></span> Sub-Servicios: Cant. 0 
                            
                        </li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-check"></i>
                        </span> Estado: 
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
                    <button class="btn btn-sm btn-success" onclick="restaurar(<?php echo $key['id']; ?>)"><i class="fas fa-redo"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="eliminar(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                  </div>
                </div>
              </div>
            </div>
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
        <!-- /.card-body -->

      </div>
      <!-- /.card -->

    </section>


<script>
           function restaurar(id = null) {

        swal({
            title: 'Restaurar Autoridad',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Restaurar',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo url('restaurar-servicio-turismo') ?>',
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
                            title: 'Restaurada la Autoridad',
                            text: 'El registro ha sido restaurado.',
                            showConfirmButton: true,
                            timer: 1500
                        }).then(function(result) {
                            location.href = "<?php echo url('servicios_turismo') ?>" 
                        });
                    },
                    error: function() {

                    }
                });
            }
        })

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
                            location.href = "<?php echo url('servicios_turismo') ?>" 
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