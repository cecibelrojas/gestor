@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-4">
                <h1 class="m-0">Libros Digitales</h1>
            </div><!-- /.col -->
            <div class="col-sm-8">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/libro_amarillo'); ?>"> Libro Amarillo</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo url('/publicaciones_ministerio'); ?>"><i class="fas fa-book"></i> Publicaciones del ministerio</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo url('/gaceta_oficial'); ?>"><i class="fas fa-book"></i> Gaceta Oficial</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo url('/colecciones'); ?>"><i class="fas fa-book"></i> Colecciones</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo url('/referencias'); ?>"><i class="fas fa-book"></i> Referencias</a></li>
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
                        <h3 class="card-title">Lista de Colecciones</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm btn-light" onclick="history.back()"><i class="fas fa-angle-left"></i> Volver</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg" id="maintable">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Foto Archivo</th>
                                    <th>Tipo de Archivo</th>
                                    <th>Creado por</th>
                                    <th>Estado</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($listar_biblioteca) > 0) : ?>
                                    <?php foreach ($listar_biblioteca  as $key) : ?>
                                        <tr>
                                            <td><?php echo $key['titulo']; ?></td>
                                            <td>
                                                 <img src="{{asset('images/icons/imagen2.png')}}" style="width: 40px;height: 40px;" class="imgpreview">

                                            </td>
                                            <td><?php
                                                switch ($key['tipo']) {
                                                    case 'A':
                                                        echo "Libro Amarillo";
                                                        break;
                                                    case 'B':
                                                        echo "Publicaciones del ministerio";
                                                        break;
                                                    case 'C':
                                                        echo "Gaceta Oficial";
                                                        break;
                                                    case 'D':
                                                        echo "Colecciones";
                                                        break;
                                                    case 'E':
                                                        echo "Referencias";
                                                        break;
                                                    default:
                                                        echo "----";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                            <?php if ($key['usureg'] == auth()->user()->id) : ?>
                                                <span>{{ auth()->user()->name }}<span> ({{ $key->created_at}})</span></span><br>
                                            <?php else : ?>
                                            <span style="font-size: 10px;">{{ auth()->user()->name }} ({{date('Y-m-d')}})</span>
                                            <?php endif; ?>

                                            </td>
                                            <td><?php echo ($key['estado'] == 'A') ? 'Activo' : 'Inactivo'; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-success" onclick="formulario_cuentos(<?php echo $key['id']; ?>)"><i class="fas fa-search"></i></button>
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
</section>
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Biblioteca y Archivo</h4>
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
<script type="text/javascript">
    
    $(document).ready(function() {

        $('#maintable').DataTable();

    });
    function formulario_cuentos(id = null) {
        $.ajax({
            url: '<?php echo url('/biblioteca_search') ?>',
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


</script>
@endsection