@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tabla de Posiciones Semifinal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Tabla de Posiciones Semifinal</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Tabla de Posiciones</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg" id="maintable">
                            <thead>
                                <tr>
                                    <th style="width: 17%;font-size: 14px;">Nombre</th>
                                    <th style="width: 7%; text-align: center;">JJ</th>
                                    <th style="width: 7%; text-align: center;">JG</th>
                                    <th style="width: 7%; text-align: center;">JP</th>
                                    <th style="width: 7%; text-align: center;">JV</th>
                                    <th style="width: 10%; text-align: center;">Estado</th>
                                    <th style="width: 10%;text-align: center;font-size: 14px;">Usu. Act</th>
                                    <th style="width: 10%;text-align: center;font-size: 14px;">Fac. Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($lista) > 0) : ?>
                                    <?php foreach ($lista as $key) : ?>
                                        <tr>
                                     
                                            <td>
                                            <select class="form-control select2" required onchange="updatescore(this,<?php echo $key['id']; ?>,'id_team')">>
                                                <?php foreach ($lista1 as $dato) : ?>
                                                  <option <?php echo ($key['id_team'] == $dato['id']) ? "selected" : ""; ?>  value="<?php echo $dato['id']; ?>"><?php echo $dato['nombre2']; ?></option>
                                                <?php endforeach; ?>  
                                            </select>
                                            <i style="float: right;display: none;" class="loader<?php echo $key['id']; ?> fa fa-spinner fa-pulse"></i>
                                            </td>
                                            <td><input type="number" value="<?php echo $key['jj']; ?>" class="form-control" style="text-align: center;" onchange="updatescore(this,<?php echo $key['id']; ?>,'jj')"></td>
                                            <td><input type="number" value="<?php echo $key['jg']; ?>" class="form-control" style="text-align: center;" onchange="updatescore(this,<?php echo $key['id']; ?>,'jg')"></td>
                                            <td><input type="number" value="<?php echo $key['jp']; ?>" class="form-control" style="text-align: center;" onchange="updatescore(this,<?php echo $key['id']; ?>,'jp')"></td>
                                            <td><input type="number" value="<?php echo $key['jv']; ?>" class="form-control" style="text-align: center;" onchange="updatescore(this,<?php echo $key['id']; ?>,'jv')"></td>
                                            <td>
                                            <select class="form-control select2" required onchange="updatescore(this,<?php echo $key['id']; ?>,'estado2')">>
                                                <option value="" <?php if ('' == $key['estado2']) { ?> selected <?php } ?>>Seleccione</option>
                                                 <option value="C" <?php if ('C' == $key['estado2']) { ?> selected <?php } ?>>Clasificado</option>
                                                 <option value="E" <?php if ('E' == $key['estado2']) { ?> selected <?php } ?>>Eliminado</option> 
                                            </select>
                                            </td>
                                            <td style="font-size: 12px;text-align: center;"><?php echo $key['editor']; ?></td>
                                            <td style="font-size: 12px;text-align: center;"><?php echo $key['updated_at']; ?></td>
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
</section>

<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Etiqueta</h4>
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

    function updatescore(element, id, field) {
        $.ajax({
            url: '<?php echo url('/updatescore_rr') ?>',
            type: 'POST',
            data: {
                id: id,
                field: field,
                valor: $(element).val()
            },
            beforeSend: function() {
                $('.loader' + id).show();
            },
            success: function(view) {
                $('.loader' + id).hide();
            },
            error: function() {
                $('.loader' + id).hide();
            }
        });
    }

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/posicion') ?>',
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
                    url: '<?php echo url('/eliminar-posicion') ?>',
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