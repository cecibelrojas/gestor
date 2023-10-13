@extends('layouts.administrador')

@section('content')

 <input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
             {!! trans('messages.autoridad') !!}: <?php echo $data['nombres'].' '.$data['apellidos']; ?>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="{{url('/ficha')}}">Fichas</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-user"></i>
              Curriculum Vitae 
            </h3>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">{!! trans('messages.educacion') !!}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">{!! trans('messages.experiencia_laboral') !!}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-idioma-tab" data-toggle="pill" href="#custom-content-below-idioma" role="tab" aria-controls="custom-content-below-idioma" aria-selected="false">{!! trans('messages.idiomas') !!}</a>
              </li>

            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                 
      				<section class="content" style="margin-top: 30px">
      			        <div class="row">
      			          <div class="col-12">
      			            <div class="card">
      			              <div class="card-header">
      			                <h3 class="card-title">{!! trans('messages.informacion_educativa') !!}</h3>

      			                <div class="card-tools">
      			                  <button class="btn btn-sm btn-light" id="btnNuevo"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
      			                </div>
      			              </div>
      			              <!-- /.card-header -->
      			              <div class="card-body table-responsive p-0">
      			                <table class="table table-hover text-nowrap">
      			                  <thead>
      			                    <tr>
      			                      <th style="font-size: 12px;">{!! trans('messages.universidad') !!}</th>
      			                      <th style="font-size: 12px;">{!! trans('messages.fecha') !!}</th>
      			                      <th style="font-size: 12px;">{!! trans('messages.titulo_obtenido') !!}</th>
                                  <th style="font-size: 12px;">{!! trans('messages.creadopor') !!}</th>
      			                      <th></th>
      			                    </tr>
      			                  </thead>
      			                  <tbody>
                                <?php if (count($educacion) > 0) : ?>
                                <?php foreach ($educacion as $key) : ?>
                                  <tr>
                                    <td style="font-size: 12px;"><?php echo $key['nombre_institucion']; ?></td>
                                    <td style="font-size: 12px;"><?php echo $key['ano_inicio']; ?></td>
                                    <td style="font-size: 12px;"><?php echo $key['titulo']; ?></td>
                                    <td style="font-size: 12px">
                                      <?php echo $key['creador']; ?> / <span><?php echo $key['created_at']; ?>
                                    </td>
                                    <td>
                                      <button class="btn btn-sm btn-info" onclick="formulario(<?php echo $key['id']; ?>,<?php echo $key['canciller_id']; ?>)"><i class="fa fa-edit"></i></button>
                                      <button class="btn btn-sm btn-danger" onclick="eliminar(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
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
      			              <!-- /.card-body -->
      			            </div>
      			            <!-- /.card -->
      			          </div>
      			        </div>
      				</section>

              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
				<section class="content" style="margin-top: 30px">
			        <div class="row">
			          <div class="col-12">
			            <div class="card">
			              <div class="card-header">
			                <h3 class="card-title">{!! trans('messages.experiencia_laboral') !!}</h3>
                      <div class="card-tools">
                         <button class="btn btn-sm btn-light" id="btnNuevo1"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                      </div>
			              </div>
			              <!-- /.card-header -->
			              <div class="card-body table-responsive p-0">
			                <table class="table table-hover text-nowrap">
			                  <thead>
			                    <tr>
			                      <th style="font-size: 12px; width: 30%">{!! trans('messages.empresa') !!}</th>
			                      <th style="font-size: 12px; width: 40%">{!! trans('messages.cargo') !!}</th>
			                      <th style="font-size: 12px; width: 10%">{!! trans('messages.fecha') !!}</th>
                            <th style="font-size: 12px;width: 10%">{!! trans('messages.creadopor') !!}</th>
			                      <th style="width: 10%"></th>
			                    </tr>
			                  </thead>
			                  <tbody>
                          <?php if (count($trabajo) > 0) : ?>
                                <?php foreach ($trabajo as $key) : ?>
                                  <tr>
                                    <td style="font-size: 12px;"><?php echo $key['empresa']; ?></td>
                                    <td style="font-size: 12px;"><?php echo $key['cargo']; ?></td>
                                    <td style="font-size: 12px;"><?php echo $key['fecha_inicio']; ?></td>
                                    <td style="font-size: 12px">
                                      <?php echo $key['creador']; ?> / <span><?php echo $key['created_at']; ?>
                                    </td>
                                    <td>
                                      <button class="btn btn-sm btn-info" onclick="formulario1(<?php echo $key['id']; ?>,<?php echo $key['canciller_id']; ?>)"><i class="fa fa-edit"></i></button>
                                      <button class="btn btn-sm btn-danger" onclick="eliminar_trabajos(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
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
			              <!-- /.card-body -->
			            </div>
			            <!-- /.card -->
			          </div>
			        </div>
				</section>
              </div>
              <div class="tab-pane fade" id="custom-content-below-idioma" role="tabpanel" aria-labelledby="custom-content-below-idioma-tab">
        <section class="content" style="margin-top: 30px">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">{!! trans('messages.idiomas') !!}</h3>

                      <div class="card-tools">
                          <button class="btn btn-sm btn-light" id="btnNuevo2"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th style="font-size: 12px;">{!! trans('messages.idioma') !!}</th>
                            <th style="font-size: 12px;">{!! trans('messages.creadopor') !!}</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (count($idiomas) > 0) : ?>
                                <?php foreach ($idiomas as $key) : ?>
                                  <tr>
                                    <td style="font-size: 12px;"><?php echo $key['idioma']; ?></td>
                                    <td style="font-size: 12px">
                                      <?php echo $key['creador']; ?> / <span><?php echo $key['created_at']; ?>
                                    </td>
                                    <td>
                                      <button class="btn btn-sm btn-info" onclick="formulario2(<?php echo $key['id']; ?>,<?php echo $key['canciller_id']; ?>)"><i class="fa fa-edit"></i></button>
                                      <button class="btn btn-sm btn-danger" onclick="eliminar_idioma(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
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
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
        </section>
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
                <h4 class="modal-title">{!! trans('messages.informacion_educativa') !!}</h4>
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
                <h4 class="modal-title">{!! trans('messages.experiencia_laboral') !!}</h4>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('messages.idiomas') !!}</h4>
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
  var canciller_id = '<?php echo $canciller_id; ?>';

    $(document).ready(function() {

        $('#maintable').DataTable();

        $('#btnNuevo').click(function() {
            formulario();
        });
        $('#btnNuevo1').click(function() {
            formulario1();
        });
        $('#btnNuevo2').click(function() {
            formulario2();
        });
    });

    function formulario(id = null) {

        $.ajax({
            url: '<?php echo url('/formulario_academico') ?>',
            type: 'POST',
            data: {
                id: id,
                canciller_id: canciller_id
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
            url: '<?php echo url('/formulario_trabajos') ?>',
            type: 'POST',
            data: {
                id: id,
                canciller_id: canciller_id
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
    function formulario2(id = null) {

        $.ajax({
            url: '<?php echo url('/formulario_idiomas') ?>',
            type: 'POST',
            data: {
                id: id,
                canciller_id: canciller_id
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
                    url: '<?php echo url('/eliminarestudios') ?>',
                    type: 'POST',
                    data: {
                        id: id,

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

       function eliminar_trabajos(id = null) {

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
                    url: '<?php echo url('/eliminarempleos') ?>',
                    type: 'POST',
                    data: {
                        id: id,

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

    function eliminar_idioma(id = null) {

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
                    url: '<?php echo url('/eliminaridiomas') ?>',
                    type: 'POST',
                    data: {
                        id: id,

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