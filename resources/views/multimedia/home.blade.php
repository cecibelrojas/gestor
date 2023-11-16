@extends('layouts.administrador')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Biblioteca de medios</h1>
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

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-header">
            <div class="card-tools">
                <button class="btn btn-sm btn-info" id="btnNuevo"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
            </div>
        </div>
        <div class="card-body pb-0">
          <div class="row">
                  <div class="filter-container p-0 row">
                    <?php if (count($lista) > 0) : ?>
                        <?php foreach ($lista as $key) : ?>                    
                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                      <a href="<?php echo env('APP_ADMIN') . "/archivos/imagenes/" . $key['imgdestacado']; ?>" data-toggle="lightbox" data-title="sample 1 - black">
                        <img src="<?php echo env('APP_ADMIN') . "/archivos/imagenes/" . $key['imgdestacado']; ?>" class="img-fluid mb-1 " style="width: 160px; height: 110px;" alt="white sample"/>
                      </a>
                    </div>
                        <?php endforeach; ?>
                    <?php endif; ?> 
                  </div>           
          </div>
        </div>
        <!-- /.card-body -->

      </div>
      <!-- /.card -->
    </section>
     <div class="modal fade" id="modal-nuevo">
        <div class="modal-dialog modal-lg">
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
                    url: '<?php echo url('/eliminarmedios') ?>',
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