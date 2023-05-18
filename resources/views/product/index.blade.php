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
                <h1 class="m-0">Publicaciones</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Publicaciones</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

    <!-- /.content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Publicaciones</h3>
                        <div class="card-tools">
                            <?php if (auth()->user()->rol == 'A' ||  auth()->user()->rol == 'E') { ?>
                                <button class="btn btn-sm btn-danger" style="background-color: #ffffff;color: #dc3545;font-weight: bold;border: 1px solid #dc3545;" onclick="location.href='<?php echo url('/papelera_publicaciones'); ?>'"><i class="fa fa-trash"></i> Papelera({{count($trash)}})</button>
                            <?php  } ?>
                            <button class="btn btn-sm btn-light" onclick="location.href='<?php echo url('/publicacion'); ?>'"><i class="fa fa-plus-circle"></i> Nueva Publicación</button>
                        </div>
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
                                <?php if (count($lista) > 0) : ?>
                                    <?php foreach ($lista as $key) : ?>
                                       <?php if ($key['papelera'] != 'P') : ?>
                                        <tr>
                                            <td><?php echo $key['id']; ?></td>
                                            <td><?php echo $key['nombre']; ?></td>
                                            <td style="font-size: 12px;"><?php echo $key['categoriades']; ?></td>
                                            <td style="font-size: 12px;"><?php echo $key['creador']; ?> <br> <span><?php echo $key['created_at']; ?></span></td>
                                            <td style="font-size: 12px;"> <?php if ($key['escritor'] != '') { ?><i class="fas fa-lightbulb" style="color:#ffd504"></i> <?php echo $key['escritor']; ?><?php  } ?></td>
                                            <td><?php
                                                switch ($key['estado']) {
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
                                            <td>
                                                
                                                <a class="btn btn-sm btn-info" href="<?php echo url('/publicacion') . "/" . $key['id']; ?>"><i class="fa fa-edit"></i></a>

                                                <?php if (auth()->user()->rol == 'A' ||  auth()->user()->rol == 'E') { ?>
                                                    <button class="btn btn-sm btn-danger" onclick="deshabilitando(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                                                <?php } ?>
                                                 <?php if (auth()->user()->rol == 'A' ||  auth()->user()->rol == 'E' ||  auth()->user()->rol == 'B') { ?>
                                                <?php if ($key['escritor'] != '') { ?>
                                                    <button class="btn btn-sm btn-success" onclick="trabajador(<?php echo $key['id']; ?>)"><i class="fas fa-unlock"></i></button>
                                                <?php  } ?>
                                                <?php  } ?>
                                            </td>
                                        </tr>
                                       <?php endif; ?>
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
            ]
        });

        $('#btnNuevo').click(function() {
            formulario();
        });

    });

    function trabajador(id = null) {

        swal({
            title: 'Desbloquear publicación',
            text: 'La siguiente acción desbloqueara la publicación para poder ser editada',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Desbloquear',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo url('/ocupar') ?>',
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
                            title: 'Tomada la Publicación',
                            text: 'El registro ha sido cambiado.',
                            showConfirmButton: true,
                            timer: 1500
                        }).then(function(result) {
                            location.href = "<?php echo url('publicacion') . "/"; ?>" + id
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
            title: '¿Seguro desea mandar a la papelera la publicación?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Deshabilitar!',
            confirmButtonColor: '#dd3333',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo url('/deshabilitar') ?>',
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