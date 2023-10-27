@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{!! trans('messages.conare') !!}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
                    <li class="breadcrumb-item active">{!! trans('messages.conare') !!}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              {!! trans('messages.secciones_internas') !!}
            </h3>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">{!! trans('messages.banner') !!}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">{!! trans('messages.contenido1') !!}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false">Logo Conare</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-settings-tab" data-toggle="pill" href="#custom-content-above-settings" role="tab" aria-controls="custom-content-above-settings" aria-selected="false">parallax</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-colecciones-tab" data-toggle="pill" href="#custom-content-above-colecciones" role="tab" aria-controls="custom-content-above-colecciones" aria-selected="false">{!! trans('messages.ubicacion_geoestrategica') !!}</a>
              </li>
            </ul>
            <div class="tab-custom-content">
              <p class="lead mb-0">Secciones Conare</p>
            </div>
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
				<?php if (count($lista) > 0) : ?>
	    			<?php foreach ($lista as $key) : ?>
	            
					<img src="<?php echo env('APP_ADMIN') . "" . $key['banner_principal']; ?>" onerror="this.src='<?php echo asset('archivos/conare/img.png'); ?>'" class="imgpreview" width="100%">

	                <div class="card-footer">
	                  <div class="text-right">
	                    <button class="btn btn-sm btn-info" onclick="formulario(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
	                  </div>
	                </div>
					    <?php endforeach; ?>
					<?php endif; ?> 

              </div>
              <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
      <?php if (count($contenido) > 0) : ?>
          <?php foreach ($contenido as $key1) : ?>
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-default">

                        <div class="card-body">
                            <h5>
                              @foreach (array_keys(config('locale.languages')) as $lang)
                                @if ($lang != App::getLocale() AND $lang == 'en')
                                  <?php echo $key1['subtitulo']; ?> 
                                @elseif ($lang != App::getLocale() AND $lang == 'es')
                                  <?php 
                                    if(!empty($key1['subtitulo_ingles'])){
                                      echo $key1['subtitulo_ingles'];
                                      }else{
                                      echo $key1['subtitulo'];  
                                    }
                                  ?> 
                                @endif
                              @endforeach                              
                            </h5>

                            <p>
                              @foreach (array_keys(config('locale.languages')) as $lang)
                                @if ($lang != App::getLocale() AND $lang == 'en')
                                  <?php echo $key1['descripcion']; ?> 
                                @elseif ($lang != App::getLocale() AND $lang == 'es')
                                  <?php 
                                    if(!empty($key1['descripcion_ingles'])){
                                      echo $key1['descripcion_ingles'];
                                      }else{
                                      echo $key1['descripcion'];  
                                    }
                                  ?> 
                                @endif
                              @endforeach
                            </p>
                        </div>
                        <div class="card-footer">
                          <div class="text-right">
                            <button class="btn btn-sm btn-info" onclick="formulario1(<?php echo $key1['id']; ?>)"><i class="fa fa-edit"></i></button>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>

                  </div>

                </div><!-- /.container-fluid -->
              </section>
            <?php endforeach; ?>
        <?php endif; ?> 
            </div>
              <div class="tab-pane fade" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
<?php if (count($imagen1) > 0) : ?>
    <?php foreach ($imagen1 as $key2) : ?>

              <div class="card card-solid">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                      <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                          Imagen
                        </div>
                        <div class="card-body pt-0">
                          <div class="row">
                            <div class="col-12">
                              <img src="<?php echo env('APP_ADMIN') . "" . $key2['imagen']; ?>" class="imgpreview" width="100%"  onerror="this.src='<?php echo asset('archivos/conare/img1.png'); ?>'">
                            </div>
                          </div>
                        </div>
                        <div class="card-footer">
                          <div class="text-right">
                            <button class="btn btn-sm btn-info" onclick="formulario2(<?php echo $key2['id']; ?>)"><i class="fa fa-edit"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
    <?php endforeach; ?>
<?php endif; ?>

              </div>
              <div class="tab-pane fade" id="custom-content-above-settings" role="tabpanel" aria-labelledby="custom-content-above-settings-tab">
<?php if (count($parallax) > 0) : ?>
    <?php foreach ($parallax as $key3) : ?>
                <img src="<?php echo env('APP_ADMIN') . "" . $key3['parallax']; ?>" onerror="this.src='<?php echo asset('archivos/conare/img.png'); ?>'" class="imgpreview" width="100%">

                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-sm btn-info" onclick="formulario3(<?php echo $key3['id']; ?>)"><i class="fa fa-edit"></i></button>
                  </div>
                </div>

    <?php endforeach; ?>
<?php endif; ?>
              </div>
              <div class="tab-pane fade" id="custom-content-above-colecciones" role="tabpanel" aria-labelledby="custom-content-above-colecciones-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">{!! trans('messages.ubicacion_geoestrategica') !!}</h3>
                                        <div class="card-tools">
                                            <button class="btn btn-sm btn-light" id="btnNuevo5"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-responsive-lg" id="maintable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">{!! trans('messages.titulo') !!}</th>
                                                    <th style="width: 10%;">direccion</th>
                                                    <th style="width: 10%;">{!! trans('messages.estado') !!}</th>
                                                    <th style="width: 10%;"></th>
                                                </tr>
                                            </thead>
                            <tbody>
                                <?php if (count($ubicacion) > 0) : ?>
                                    <?php foreach ($ubicacion as $key4) : ?>
                                        <tr>
                                            <td><?php echo $key4['titulo']; ?></td>
                                            <td><?php echo $key4['direccion']; ?></td>
                                            <td>
                                              <?php
                                                    if($key4['estado']=='A'){

                                                         echo "<span class='right badge badge-success'> Activo </span>";

                                                    }else{

                                                        echo "<span class='right badge badge-danger'> Inactivo </span>";
                                                    }
                                               ?>

                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="formulario4(<?php echo $key4['id']; ?>)"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminar(<?php echo $key4['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
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
          <!-- /.card -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	<div class="modal fade" id="modal-nuevo">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Conare</h4>
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
  <div class="modal fade" id="modal-nuevo1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('messages.colecciones') !!}</h4>
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
  <div class="modal fade" id="modal-nuevo2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('messages.normas') !!}</h4>
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
  <div class="modal fade" id="modal-nuevo3">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-content3"></div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#maintable').DataTable();

        $('#btnNuevo5').click(function() {
            formulario4();
        });
    });

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/bannerconare_new') ?>',
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
            url: '<?php echo url('/contenido_conare') ?>',
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
    function formulario2(id = null) {
        $.ajax({
            url: '<?php echo url('/imagen_conare') ?>',
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
    function formulario3(id = null) {
        $.ajax({
            url: '<?php echo url('/parallax_conare') ?>',
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
    function formulario4(id = null) {
        $.ajax({
            url: '<?php echo url('/lista_ubicaciones') ?>',
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
                    url: '<?php echo url('/eliminar_ubicacion_geo') ?>',
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