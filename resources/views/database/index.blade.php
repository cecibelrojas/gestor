@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Banco de Datos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Banco de Datos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cabecera</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light" style="border: 1px solid #fff;" onclick="formulario()"><i class="fa fa-plus-circle"></i> Nuevo</button>
                            <button class="btn btn-sm btn-danger" style="border: 1px solid #fff;" onclick="eliminar()"><i class="fa fa-trash-o"></i> Eliminar</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="maintable">
                            <thead>
                                <tr>
                                    <th style="width: 10%;font-size: 12px;">Código</th>
                                    <th style="font-size: 12px;">Nombre</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Detalles</h3>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-light" style="border: 1px solid #fff;" onclick="formulario2()"><i class="fa fa-plus-circle"></i> Nuevo</button>
                            <button class="btn btn-sm btn-danger" style="border: 1px solid #fff;" onclick="eliminar2()"><i class="fa fa-trash-o"></i> Eliminar</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="secondtable">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px;">Item</th>
                                    <th style="font-size: 12px;">Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
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
                <h4 class="modal-title">Cabecera</h4>
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
<div class="modal fade" id="modal-nuevo2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalle</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-content2"></div>
            </div>
        </div>
    </div>
</div>
<script>
    var dataSet = <?php echo json_encode($bancodatos); ?>;

    var table = $('#maintable').DataTable({
        data: dataSet,
        select: {
            style: 'single'
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'nombre',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return data + ' <i onclick=formulario(' + row.id + ') class="fa fa-pencil edit-pen"></i>';
                    }
                    return data;
                }
            }

        ]
    });

    table.on('select', function(e, dt, type, indexes) {
        var rowData = table.rows(indexes).data().toArray();
        obtener_detalle(rowData[0].id);
    });

    var table2 = $('#secondtable').DataTable({
        data: [],
        select: {
            style: 'single'
        },
        columns: [{
                data: 'item'
            },
            {
                data: 'nombre',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return data + ' <i onclick=formulario2("' + row.item + '","U") class="fa fa-pencil edit-pen"></i>';
                    }
                    return data;
                }
            }
        ]
    });

    function eliminar() {

        var data = table.row({
            selected: true
        }).data();

        if (typeof data === 'undefined') {
            swal({
                type: "info",
                title: "¡Debe seleccionar un registro!",
                showConfirmButton: true
            });
            return false;
        }

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
                    url: '<?php echo url('/eliminar-cabecera') ?>',
                    type: 'POST',
                    data: {
                        id: data.id
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
                            //location.reload();
                            filtrar();
                        });
                    },
                    error: function() {

                    }
                });
            }
        })

    }

    function eliminar2() {

        var data = table2.row({
            selected: true
        }).data();

        if (typeof data === 'undefined') {
            swal({
                type: "info",
                title: "¡Debe seleccionar un registro!",
                showConfirmButton: true
            });
            return false;
        }

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
                    url: '<?php echo url('/eliminar-detalle') ?>',
                    type: 'POST',
                    data: {
                        id: data.id,
                        item: data.item
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
                            //location.reload();
                            filtrar2();
                        });
                    },
                    error: function() {

                    }
                });
            }
        })

    }


    function obtener_detalle(det) {

        $.ajax({
            url: '<?php echo url('/bancodatos-detalles') ?>',
            type: 'POST',
            data: {
                id: det
            },
            beforeSend: function() {

            },
            success: function(response) {
                table2.data(response);
                table2.clear();
                table2.rows.add(response).draw();
            },
            error: function() {

            }
        });
    }

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/bancodatos-cabecera') ?>',
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
        $.ajax({
            url: '<?php echo url('/bancodatos-cabeceras') ?>',
            type: 'POST',
            beforeSend: function() {

            },
            success: function(response) {
                table.data(response);
                table.clear();
                table.rows.add(response).draw();
            },
            error: function() {

            }
        });
    }

    function filtrar2() {

        var data = table.row({
            selected: true
        }).data();

        $.ajax({
            url: '<?php echo url('/bancodatos-detalles') ?>',
            type: 'POST',
            data: {
                id: data.id
            },
            beforeSend: function() {

            },
            success: function(response) {
                table2.data(response);
                table2.clear();
                table2.rows.add(response).draw();
            },
            error: function() {

            }
        });
    }

    function formulario2(item = null, accion = 'I') {

        var data = table.row({
            selected: true
        }).data();

        if (typeof data === 'undefined') {
            swal({
                type: "info",
                title: "¡Debe seleccionar un registro cabecera!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/bancodatos-detalle') ?>',
            type: 'POST',
            data: {
                id: data.id,
                item: item,
                accion: accion
            },
            beforeSend: function() {
                $('#modal-nuevo2').modal('show');
                $('#form-content2').html("Cargando <i class='fa fa-spinner fa-pulse'></i>");
            },
            success: function(view) {
                $('#form-content2').html(view);
            },
            error: function() {
                $('#form-content2').html("Error al cargar ventana.");
            }
        });
    }
</script>
@endsection