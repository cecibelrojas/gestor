@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
@if (Session::has("mensaje"))
<script>
    notie.alert({
        type: 3,
        text: '<?php echo session('mensaje'); ?>',
        time: 10
    })
</script>
@endif
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Papelera de Publicaciones</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/publicaciones'); ?>">Publicaciones</a></li>
                    <li class="breadcrumb-item active">Papelera de Publicaciones</li>
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
                        <h3 class="card-title">Lista de Publicaciones Deshabilitadas</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg" id="maintable">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">ID</th>
                                    <th style="font-size: 12px;">Nombre</th>
                                    <th style="font-size: 12px;">Categoria</th>
                                    <th style="font-size: 12px;">Creador</th>
                                    <th style="font-size: 12px;">Ocupado</th>
                                    <th style="font-size: 12px;">Publicación</th>
                                    <th style="width: 15%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($trash) > 0 ) : ?>
                                    <?php foreach ($trash as $key) : ?>
                                        <tr>
                                            <td><?php echo $key['id']; ?></td>
                                            <td><?php echo $key['nombre']; ?> </td>
                                            <td style="font-size: 12px;"><?php echo $key['categoriades']; ?></td>
                                            <td style="font-size: 12px;"><?php echo $key['creador']; ?> <br> <span><?php echo $key['created_at']; ?></span> </td>
                                            <td style="font-size: 12px;"> <?php if ($key['escritor'] != '') { ?><i class="fas fa-lightbulb" style="color:#ffd504"></i> <?php echo $key['escritor']; ?><?php  } ?></td>
                                            <td><?php
                                                switch ($key['estado']) {
                                                    case 'A':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                                            echo "<span class='right badge badge-success' style='font-size:14px; color: #fff'>Publicada</span>";
                                                            break;
                                                        }
                                                    case 'I':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                                            echo "<span class='right badge badge-warning' style='font-size:14px; color: #fff'>Borrador</span>";
                                                            break;
                                                        }
                                                    case 'R':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                                            echo "<span class='right badge badge-info' style='background-color:#9917b8!important; font-size:14px; color: #fff'>Para Corrección</span>";
                                                            break;
                                                        }
                                                    case 'P':
                                                        if (auth()->user()->rol == 'A' || auth()->user()->rol == 'B' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                                            echo "<span class='right badge badge-primary' style='background-color:#14742a!important; font-size:14px; color: #fff'>Publicada</span>";
                                                            break;
                                                        }
                                                    default:
                                                        echo "----";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                    <button class="btn btn-sm btn-success" onclick="restaurar(<?php echo $key['id']; ?>)"><i class="fas fa-redo"></i></button>
                                                     <?php if (auth()->user()->rol == 'A') { ?>
                                                    <button class="btn btn-sm btn-danger" onclick="eliminar(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                                                <?php } ?>
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
<script>
    $(document).ready(function() {

        $('#maintable').DataTable({
            order: [
                [6, 'desc']
            ],

        });


        $('#btnNuevo').click(function() {
            formulario();
        });

    });


           function restaurar(id = null) {

        swal({
            title: 'Restaurar publicación',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Restaurar',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo url('restaurar-pub') ?>',
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
                            title: 'Restaurada la Publicación',
                            text: 'El registro ha sido restaurado.',
                            showConfirmButton: true,
                            timer: 1500
                        }).then(function(result) {
                            location.href = "<?php echo url('publicaciones') ?>" 
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
                    url: '<?php echo url('/eliminarproducto') ?>',
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
                            location.href = "<?php echo url('publicaciones') ?>" 
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