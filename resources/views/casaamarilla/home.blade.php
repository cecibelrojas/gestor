@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{!! trans('messages.casaamarilla') !!}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
                    <li class="breadcrumb-item active">{!! trans('messages.casaamarilla') !!}</li>
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
                <a class="nav-link" id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false">{!! trans('messages.imagen_biblioteca') !!}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-settings-tab" data-toggle="pill" href="#custom-content-above-settings" role="tab" aria-controls="custom-content-above-settings" aria-selected="false">parallax</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-colecciones-tab" data-toggle="pill" href="#custom-content-above-colecciones" role="tab" aria-controls="custom-content-above-colecciones" aria-selected="false">{!! trans('messages.colecciones') !!}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-normas-tab" data-toggle="pill" href="#custom-content-above-normas" role="tab" aria-controls="custom-content-above-normas" aria-selected="false">{!! trans('messages.normas') !!}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-otrositems-tab" data-toggle="pill" href="#custom-content-above-otrositems" role="tab" aria-controls="custom-content-above-otrositems" aria-selected="false">Items</a>
              </li>
            </ul>
            <div class="tab-custom-content">
              <p class="lead mb-0">Secciones Casa Amarilla</p>
            </div>
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
			<?php if (count($lista) > 0) : ?>
    			<?php foreach ($lista as $key) : ?>
            
				<img src="<?php echo env('APP_ADMIN') . "" . $key['banner_principal']; ?>" onerror="this.src='<?php echo asset('archivos/casa_amarilla/img.png'); ?>'" class="imgpreview" width="100%">

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
                                  <?php echo $key1['titulo']; ?> 
                                @elseif ($lang != App::getLocale() AND $lang == 'es')
                                  <?php 
                                    if(!empty($key1['titulo_ingles'])){
                                      echo $key1['titulo_ingles'];
                                      }else{
                                      echo $key1['titulo'];  
                                    }
                                  ?> 
                                @endif
                              @endforeach                              
                            </h5>

                            <p>
                              @foreach (array_keys(config('locale.languages')) as $lang)
                                @if ($lang != App::getLocale() AND $lang == 'en')
                                  <?php echo $key1['contenido1']; ?> 
                                @elseif ($lang != App::getLocale() AND $lang == 'es')
                                  <?php 
                                    if(!empty($key1['contenido1_ingles'])){
                                      echo $key1['contenido1_ingles'];
                                      }else{
                                      echo $key1['contenido1'];  
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
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                      <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                          Imagen
                        </div>
                        <div class="card-body pt-0">
                          <div class="row">
                            <div class="col-12">
                              <img src="<?php echo env('APP_ADMIN') . "" . $key2['img1']; ?>" class="imgpreview" width="100%"  onerror="this.src='<?php echo asset('archivos/casa_amarilla/img1.png'); ?>'">
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
                <img src="<?php echo env('APP_ADMIN') . "" . $key3['parallax1']; ?>" onerror="this.src='<?php echo asset('archivos/casa_amarilla/img.png'); ?>'" class="imgpreview" width="100%">

                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-sm btn-info" onclick="formulario3(<?php echo $key3['id']; ?>)"><i class="fa fa-edit"></i></button>
                  </div>
                </div>
                <br>
                <img src="<?php echo env('APP_ADMIN') . "" . $key3['parallax2']; ?>" onerror="this.src='<?php echo asset('archivos/casa_amarilla/img.png'); ?>'" class="imgpreview" width="100%">

                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-sm btn-info" onclick="formulario4(<?php echo $key3['id']; ?>)"><i class="fa fa-edit"></i></button>
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
                                        <h3 class="card-title">{!! trans('messages.colecciones') !!}</h3>
                                        <div class="card-tools">
                                            <button class="btn btn-sm btn-light" id="btnNuevo5"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-responsive-lg" id="maintable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">{!! trans('messages.titulo') !!}</th>
                                                    <th style="width: 10%;">{!! trans('messages.imagen') !!}</th>
                                                    <th style="width: 10%;">{!! trans('messages.estado') !!}</th>
                                                    <th style="width: 10%;"></th>
                                                </tr>
                                            </thead>
                            <tbody>
                                <?php if (count($coleccion) > 0) : ?>
                                    <?php foreach ($coleccion as $key4) : ?>
                                        <tr>
                                            <td><?php echo $key4['titulo']; ?></td>
                                            <td><img src="{{asset('images/icons/imagen2.png')}}" style="width: 40px;height: 40px;" class="imgpreview"></td>
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
                                                <button class="btn btn-sm btn-info" onclick="formulario5(<?php echo $key4['id']; ?>)"><i class="fa fa-edit"></i></button>
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
              <div class="tab-pane fade" id="custom-content-above-normas" role="tabpanel" aria-labelledby="custom-content-above-normas-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">{!! trans('messages.normas') !!}</h3>
                                        <div class="card-tools">
                                            <button class="btn btn-sm btn-light" id="btnNuevo6"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-responsive-lg" id="maintable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 90%;">Items</th>
                                                    <th style="width: 10%;"></th>
                                                </tr>
                                            </thead>
                            <tbody>
                                <?php if (count($normas) > 0) : ?>
                                    <?php foreach ($normas as $key5) : ?>
                                        <tr>
                                            <td><?php echo $key5['items']; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="formulario6(<?php echo $key5['id']; ?>)"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminar1(<?php echo $key5['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
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
              <div class="tab-pane fade" id="custom-content-above-otrositems" role="tabpanel" aria-labelledby="custom-content-above-otrositems-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Items</h3>
                                        <div class="card-tools">
                                            <button class="btn btn-sm btn-light" id="btnNuevo7"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-responsive-lg" id="maintable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">icono</th>
                                                    <th style="width: 40%;">Titulo</th>
                                                    <th style="width: 20%;">estado</th>
                                                    <th style="width: 20%;"></th>
                                                </tr>
                                            </thead>
                            <tbody>
                                <?php if (count($items) > 0) : ?>
                                    <?php foreach ($items as $key6) : ?>
                                        <tr>
                                            <td><img src="{{asset('images/icons/imagen2.png')}}" style="width: 40px;height: 40px;" class="imgpreview"></td>
                                            <td><?php echo $key6['titulo']; ?></td>
                                            <td>
                                              <?php
                                                    if($key6['estado']=='A'){

                                                         echo "<span class='right badge badge-success'> Activo </span>";

                                                    }else{

                                                        echo "<span class='right badge badge-danger'> Inactivo </span>";
                                                    }
                                               ?>

                                            </td>

                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="formulario7(<?php echo $key6['id']; ?>)"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminar2(<?php echo $key6['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
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
	                <h4 class="modal-title">{!! trans('messages.casaamarilla') !!}</h4>
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
            formulario5();
        });
        $('#btnNuevo6').click(function() {
            formulario6();
        });
        $('#btnNuevo7').click(function() {
            formulario7();
        });
    });

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/bannercasamarilla_new') ?>',
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
            url: '<?php echo url('/contenido_principal') ?>',
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
            url: '<?php echo url('/imagen_principal') ?>',
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
            url: '<?php echo url('/parallax_coleccion') ?>',
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
            url: '<?php echo url('/parallax_normas') ?>',
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
    function formulario5(id = null) {
        $.ajax({
            url: '<?php echo url('/lista_colecciones') ?>',
            type: 'POST',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#modal-nuevo1').modal('show');
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
    function formulario6(id = null) {
        $.ajax({
            url: '<?php echo url('/lista_normas') ?>',
            type: 'POST',
            data: {
                id: id
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
    function formulario7(id = null) {
        $.ajax({
            url: '<?php echo url('/lista_items') ?>',
            type: 'POST',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#modal-nuevo3').modal('show');
                $('#form-content3').html("Cargando <i class='fa fa-spinner fa-pulse'></i>");
            },
            success: function(view) {
                $('#form-content3').html(view);
            },
            error: function() {
                $('#form-content3').html("Error al cargar ventana.");
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
                    url: '<?php echo url('/eliminar_coleccion') ?>',
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
    function eliminar1(id = null) {

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
                    url: '<?php echo url('/eliminar_normas') ?>',
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
    function eliminar2(id = null) {

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
                    url: '<?php echo url('/eliminar_items') ?>',
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