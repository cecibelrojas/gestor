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
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-body" style="padding: 1px 15px 7px 5px;">
                <div>
                <div>
                  <div class="mb-2">
                    <div class="float-left" style="margin-right: 20px">
                      <select class="custom-select" style="width: auto;" data-sortorder="">
                        <option value="index"> Todos los medios </option>
                        <option value="sortData">Imágen</option>
                        <option value="sortData">Video</option>
                        <option value="sortData">Documentos</option>
                      </select>
                    </div>
                    <div class="float-left" style="margin-right: 10px">
                    <input type="date" class="form-control" id="filtroFecini" value="<?php echo date("Y-m-d", strtotime(date('Y-m-d') . "- 2 month")); ?>"> 
                    </div>
                    <div class="float-left">
                    <input type="date" class="form-control" id="filtroFecfin" value="<?php echo date('Y-m-d'); ?>"> 
                    </div>
                    <div class="float-right">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
                            <div class="input-group-append" style="border:1px solid #cdcdcd">
                                <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section  class="content">
        <div class="filter-container">
            <div class="row">
            <?php if (count($lista) > 0) : ?>
                <?php foreach ($lista as $key) : ?>                         
                    <div class="filtr-item col-md-2" data-category="1" data-sort="<?php echo $key['titulo']; ?>" style="border: 1px solid #cdcdcd;padding: 8px;">
                      <a href="#" onclick="formulario(<?php echo $key['id']; ?>)" data-toggle="lightbox" data-title="<?php echo $key['titulo']; ?>">
                        <?php if ($key['tipo'] == 'I') : ?>
                           <img src="<?php echo env('APP_ADMIN') . "/archivos/imagenes_medios/" . $key['archivo']; ?>" class="img-fluid mb-2" style="height: 150px;width: 100%;object-fit: cover;"/>
                        <?php endif;  ?>
                        <?php if ($key['tipo'] == 'F') :  ?>
                           <center><img src="{{asset('images/icons/pdf.png')}}" class="img-fluid mb-2" style="height: 120px;;object-fit: cover;" alt="<?php echo $key['titulo']; ?>" /></center>
                            <div style="border-top: 1px solid #cdcdcd"><span class="m-auto" style="font-size: 12px;"><?php echo $key['titulo']; ?></span></div>
                         <?php endif;  ?>
                         <?php if ($key['tipo'] == 'V') :  ?>
                           <center><img src="{{asset('images/icons/uploadedvideo.png')}}" class="img-fluid mb-2" style="height: 120px;width: 70%;object-fit: cover;" alt="<?php echo $key['titulo']; ?>" /></center>
                            <div style="border-top: 1px solid #cdcdcd"><span class="m-auto" style="font-size: 12px;"><?php echo $key['titulo']; ?></span></div>
                         <?php endif;  ?>                            
                      </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            </div>
        </div>
        <div class="text-center" style="margin-top: 20px;margin-bottom: 20px">
            <p>
                <a href="#" class="btn btn-default btn-sm" id="enlaceajax">Cargar más</a>
            </p>
        </div>
        <div id="cargando" class="text-center" style="display:none; color: green;">Cargando...</div>
        <div id="destino"></div>
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

       $("#enlaceajax").click(function(evento){
          evento.preventDefault();
          $("#cargando").css("display", "inline");
          $("#destino").load("<?php echo url('/multimedia_todos') ?>", function(){
             $("#cargando").css("display", "none");
          });
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