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
                <h1 class="m-0">{!! trans('messages.publicaciones') !!}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
                    <li class="breadcrumb-item active">{!! trans('messages.publicaciones') !!}</li>
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
                        <h3 class="card-title">{!! trans('messages.publicaciones_lista') !!}</h3>
                        <div class="card-tools">
                            <?php if (auth()->user()->rol == 'A' ||  auth()->user()->rol == 'E') { ?>
                                <button class="btn btn-sm btn-danger" style="background-color: #ffffff;color: #dc3545;font-weight: bold;border: 1px solid #dc3545;" onclick="location.href='<?php echo url('/papelera_publicaciones'); ?>'"><i class="fa fa-trash"></i> {!! trans('messages.papelera') !!}({{count($trash)}})</button>
                            <?php  } ?>
                            <button class="btn btn-sm btn-light" onclick="location.href='<?php echo url('/publicacion'); ?>'"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevopost') !!}</button>
                        </div>
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
                                            <th style="font-size: 12px;">ID</th>
                                            <th style="font-size: 12px;">{!! trans('messages.nombre') !!}</th>
                                            <th style="font-size: 12px;">{!! trans('messages.categorias') !!}</th>
                                            <th style="font-size: 12px;">{!! trans('messages.creador') !!}</th>
                                            <th style="font-size: 12px;">{!! trans('messages.ocupado') !!}</th>
                                            <th style="font-size: 12px;">{!! trans('messages.publicacion') !!}</th>
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
                                                                    if (auth()->user()->rol == 'A' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                                                        echo "<span class='right badge badge-success' style='font-size:14px; color: #fff'>Publicada</span>";
                                                                        break;
                                                                    }
                                                                case 'I':
                                                                    if (auth()->user()->rol == 'A' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                                                        echo "<span class='right badge badge-warning' style='font-size:14px; color: #fff'>Borrador</span>";
                                                                        break;
                                                                    }
                                                                case 'R':
                                                                    if (auth()->user()->rol == 'A' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                                                        echo "<span class='right badge badge-info' style='background-color:#9917b8!important; font-size:14px; color: #fff'>Para Corrección</span>";
                                                                        break;
                                                                    }
                                                                case 'P':
                                                                    if (auth()->user()->rol == 'A' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                                                        echo "<span class='right badge badge-primary' style='background-color:#007bff!important; font-size:14px; color: #fff'>Publicada</span>";
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
                                                            <?php if (auth()->user()->rol == 'A' ||  auth()->user()->rol == 'E') { ?>
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
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {

        var table = $('#maintable').DataTable({
            pageLength: 50,
            order: [
                [6, 'desc']
            ]
        });
        $('#btnNuevo').click(function() {
            formulario();
        });
        $('#filtroFecini').change(function() {
            filtrar();
        });

        $('#filtroFecfin').change(function() {
            filtrar();
        });
    });
    function filtrar() {
       $.ajax({
            url: '<?php echo url('/listado_publicaciones') ?>',
            type: 'POST',
            data: {
                fecini: $('#filtroFecini').val(),
                 fecfin: $('#filtroFecfin').val()
            },
            beforeSend: function() {

            },
            success: function(data) {
                table.data(data.listado);
                table.clear();
                table.rows.add(data.listado).draw();
            },
            error: function() {

            }
        });
    }
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

    function filtrar() {

        if ($('#filtroFecini').val() == '' || $('#filtroFecfin').val() == '') {
            return;
        }

        $.ajax({
            url: '<?php echo url('/listado_publicaciones') ?>',
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