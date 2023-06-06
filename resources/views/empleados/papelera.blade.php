@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Fichas de Autoridades Deshabilitadas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/ficha'); ?>">Ficha</a></li>
                    <li class="breadcrumb-item active">Papelera de Publicaciones</li>
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
                        <h3 class="card-title">Lista de Autoridades Deshabilitadas</h3>
                    </div>
        <div class="card-body pb-0">
          <div class="row">
            <?php if (count($trash) > 0) : ?>
                <?php foreach ($trash as $key) : ?>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  <?php
                        if($key['tipo']=='A'){

                             echo "Ministro(a)";

                        }else{

                            echo "Viceministro(a)";
                        }
                   ?>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?php echo $key['nombres'].' '.$key['apellidos']; ?></b></h2>
                      <p class="text-muted text-sm"><b>Cargo: </b> <?php echo $key['cargo']; ?> </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Tipo: 
                        <strong>
                          <?php
                                if($key['tipo']=='A'){

                                     echo "Ministro(a)";

                                }else{

                                    echo "Viceministro(a)";
                                }
                           ?>
                        </strong></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-check"></i></span> Estatus: 

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
                      <img src="<?php echo env('APP_ADMIN') . "" . $key['foto']; ?>" alt="user-avatar" class="img-circle img-fluid">
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
                     <i class="fas fa-exclamation-triangle"></i> No hay Ficha para mostrar.
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
                    url: '<?php echo url('restaurar-empleado') ?>',
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
                            location.href = "<?php echo url('ficha') ?>" 
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
                    url: '<?php echo url('/eliminarficha') ?>',
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
                            location.href = "<?php echo url('ficha') ?>" 
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