@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Resultados de Juegos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">Inicio</a></li>
                    <li class="breadcrumb-item active">Resultados de Juegos</li>
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
                    <div class="card-body">
                        <div class="row">
                            <!-- team 1 -->
                            <?php if (count($programaciones) > 0) : ?>
                                <?php foreach ($programaciones as $key) : ?>
                                    <?php
                                    $split = explode(' ', $key['fecha']);
                                    $date = date_create($split[0]);
                                    $format = date_format($date, 'd, M Y');
                                    ?>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header border-transparent" style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);color: #ffffff;">
                                                <h3 class="card-title"><?php echo $format . " a las " . $split[1]; ?></h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table m-0">
                                                        <tbody>
                                                            <tr>
                                                                <?php if (count($key['detalles']) > 0) : ?>
                                                                    <?php foreach ($key['detalles'] as $index => $det) : ?>
                                                                        <td style="text-align: center;<?php echo ($index == 0) ? "border-right: 1px solid #d9d9d9" : "" ?>">
                                                                            <b style="margin-bottom: 10px;font-size: 13px;"><?php echo $det['nombreteam']; ?></b><br>
                                                                            <img style="object-fit: contain;width: 80px;height: 80px;" src="<?php echo url('/') . $det['logo']; ?>">
                                                                            <br>
                                                                            <?php if($det['casa'] == 'S'){ ?>
                                                                            <label>Local</label>
                                                                            <?php } else {  ?>
                                                                            <label>Visitante</label>
                                                                            <?php } ?>
                                                                            <div style="border-top: 1px solid #d9d9d9;padding: 10px;margin-top: 10px;">
                                                                                <label style="font-size: 11px;float: left;margin: 10px;">Puntaje <i style="float: right;display: none;" class="loader<?php echo $det['item']; ?> fa fa-spinner fa-pulse"></i></label>
                                                                                <input type="number" name="" value="<?php echo $det['resultado']; ?>" class="form-control" style="width: 50%;float: left;"  onchange="updatescoreresult(this,<?php echo $det['id']; ?>,<?php echo $det['item']; ?>,'resultado')">
                                                                            </div>
                                                                        </td>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <!-- /.team 1 -->
                                <?php endforeach; ?>
                            <?php else : ?>

                            <?php endif; ?>

                        </div>

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

    function updatescoreresult(element, id, item, field) {
        $.ajax({
            url: '<?php echo url('/updatescoreresult') ?>',
            type: 'POST',
            data: {
                id: id,
                item: item,
                field: field,
                valor: $(element).val()
            },
            beforeSend: function() {
                $('.loader' + id).show();
                $('.loader' + item).show();
            },
            success: function(view) {
                $('.loader' + id).hide();
                $('.loader' + item).hide();
            },
            error: function() {
                $('.loader' + id).hide();
                $('.loader' + item).hide();
            }
        });
    }

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/result') ?>',
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
                    url: '<?php echo url('/eliminar-result') ?>',
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