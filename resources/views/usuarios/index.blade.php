@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
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
                        <h3 class="card-title">Lista de Usuarios</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light" id="btnNuevo"><i class="fa fa-plus-circle"></i> Nuevo Usuarios</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg" id="maintable">
                            <thead>
                                <tr>
                                    <th>Nombre de Usuario</th>
                                    <th>Correo Electrónico</th>
                                    <th>Rol</th>
                                    <th style="width: 10%;">Foto</th>
                                    <th>Estado</th>
                                    <th style="width: 15%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($lista) > 0) : ?>
                                    <?php foreach ($lista as $key) : ?>
                                        <tr>
                                            <td><?php echo $key['name']; ?></td>
                                            <td><?php echo $key['email']; ?></td>
                                            <td><?php
                                                switch ($key['rol']) {
                                                    case 'A':
                                                        echo "Administrador";
                                                        break;
                                                    case 'B':
                                                        echo 'Consulares';
                                                        break;
                                                    case 'C':
                                                        echo 'Redactor';
                                                        break;
                                                    case 'D':
                                                        echo 'Corrector';
                                                        break;
                                                    case 'E':
                                                        echo 'Jefe Redacción / Información';
                                                        break;
                                                    case 'F':
                                                        echo 'Biblioteca ';
                                                        break;
                                                    case 'G':
                                                        echo 'Turismo';
                                                        break;
                                                    case 'H':
                                                        echo 'Audiovisuales';
                                                        break;
                                                    case 'I':
                                                        echo 'Fotografía';
                                                        break;
                                                    default:
                                                        echo "No tiene Perfil de Usuario";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <img onclick="$('#foto').trigger('click');" src="<?php echo !empty($key['foto']) ? url('/') . $key['foto'] : asset('images/icons/default-image.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 30px;height: 30px;" class="rounded-circle">
                                            </td>

                                            <td><?php echo ($key['estado'] == 'A') ? 'Activo' : 'Inactivo'; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="formulario(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-success" onclick="formulario_contrasena(<?php echo $key['id']; ?>)"><i class="fa fa-key"></i></button>
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
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-content" enctype="multipart/form-data"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-contrasena">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar Contraseña</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-content1"></div>
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
        $('#btnContrasena').click(function() {
            formulario_contrasena();
        });

    });

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/usuario') ?>',
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

    function formulario_contrasena(id = null) {
        $.ajax({
            url: '<?php echo url('/usuario-contrasena') ?>',
            type: 'POST',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#modal-contrasena').modal('show');
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
                    url: '<?php echo url('/eliminar-usuario') ?>',
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