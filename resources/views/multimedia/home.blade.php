@extends('layouts.administrador')
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Biblioteca de medios&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-default" id="btnNuevo1"><i class="fa fa-plus-circle"></i> Añadir nuevo </button></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Biblioteca de medios</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Biblioteca de medios</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <label style="font-weight: bold;color: #3F51B5;">Fecha Inicio</label><br>
                                <input type="date" class="form-control" id="filtroFecini" value="<?php echo date("Y-m-d", strtotime(date('Y-m-d') . "- 2 month")); ?>">
                            </div>
                            <div class="col-lg-2">
                                <label style="font-weight: bold;color: #3F51B5;">Fecha Fin</label><br>
                                <input type="date" class="form-control" id="filtroFecfin" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                            </div>
                            <div class="col-lg-12" id="table-content">
                                <table class="table table-responsive-lg" id="maintable">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%;">Archivo</th>
                                            <th>Título</th>
                                            <th>Original</th>
                                            <th>Autor</th>
                                            <th>Fecha</th>
                                            <th style="width: 15%;"></th>
                                        </tr>
                                    </thead>
                            <tbody>
                                <?php if (count($lista) > 0) : ?>
                                    <?php foreach ($lista as $key) : ?>
                                        <tr>
                                            <td>
                                                <?php if ($key['tipo'] == 'I') : ?>
                                                   <img src="<?php echo env('APP_ADMIN') . "/archivos/imagenes_medios/" . $key['archivo']; ?>" class="img-fluid mb-2" style="width: 60%;object-fit: cover;"/>
                                                <?php endif;  ?>
                                                <?php if ($key['tipo'] == 'F') :  ?>
                                                   <img src="{{asset('images/icons/document.png')}}" class="img-fluid mb-2" style="height: 80px;object-fit: cover;" alt="<?php echo $key['titulo']; ?>" />
                                                 <?php endif;  ?>
                                                 <?php if ($key['tipo'] == 'V') :  ?>
                                                   <img src="{{asset('images/icons/uploadedvideo.png')}}" class="img-fluid mb-2" style="width: 50%;object-fit: cover;" alt="<?php echo $key['titulo']; ?>" />
                                                 <?php endif;  ?> 
                                            </td>
                                            <td><?php echo $key['titulo']; ?></td>
                                            <td><?php echo $key['originalname']; ?></td>
                                            <td><?php echo $key['creador']; ?></td>
                                            <td><span><?php echo $key['created_at']; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="formulario(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminar(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <div class="modal fade" id="modal-nuevo">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Medios</h4>
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

        $('#btnNuevo1').click(function() {
            formulario1();
        });

        $('#filtroFecini').change(function() {
            filtrar();
        });

        $('#filtroFecfin').change(function() {
            filtrar();
        });

    });

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/medios_uploads') ?>',
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
    function formulario1(id = null) {
        $.ajax({
            url: '<?php echo url('/medios_uploads_nuevo') ?>',
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
    function filtrar() {

        if ($('#filtroFecini').val() == '' || $('#filtroFecfin').val() == '') {
            return;
        }

        $.ajax({
            url: '<?php echo url('/multimedia_productos') ?>',
            type: 'POST',
            data: {
                fecini: $('#filtroFecini').val(),
                fecfin: $('#filtroFecfin').val()
            },
            beforeSend: function() {
                $('#table-content').html('Procesando <i class="fa fa-spinner fa-pulse"></i>');
            },
            success: function(view) {
                $('#table-content').html(view);
            },
            error: function() {

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
                    url: '<?php echo url('/eliminarmultimedio') ?>',
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
</script>       
@endsection