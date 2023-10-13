@extends('layouts.administrador')

@section('content')
 <input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
             {!! trans('messages.detalle_subservicio') !!}
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{!! trans('messages.inicio') !!}</a></li>
              <li class="breadcrumb-item active"><a href="{{url('/servicios')}}">{!! trans('messages.servicioconsular') !!}</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-check"></i>
                  @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo $data['nombre_subservicio'];  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo $data['nombre_subservicio_ingles'];  ?>  
                   @endif
                 @endforeach 
            </h3>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Contenido</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Servicios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill" href="#custom-content-below-messages" role="tab" aria-controls="custom-content-below-messages" aria-selected="false">Infografías</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill" href="#custom-content-below-settings" role="tab" aria-controls="custom-content-below-settings" aria-selected="false">Videos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-preguntas-tab" data-toggle="pill" href="#custom-content-below-preguntas" role="tab" aria-controls="custom-content-below-preguntas" aria-selected="false">Preguntas Frecuentes</a>
              </li>

            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
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
                      <div class="col-12">
                        <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th style="font-size: 12px;">Titulo Principal</th>
                                  <th style="font-size: 12px;">{!! trans('messages.creadopor') !!}</th>
                                  <th style="font-size: 12px;">{!! trans('messages.modificadopor') !!}</th>
                                  <th style="font-size: 12px;">{!! trans('messages.estado') !!}</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (count($detalle_subservicio) > 0) : ?>
                                <?php foreach ($detalle_subservicio as $key) : ?>
                                  <tr>
                                    <td style="font-size: 12px;"><?php echo $key['titulo_principal']; ?></td>
                                    <td style="font-size: 12px">
                                      <?php echo $key['creador']; ?> / <span><?php echo $key['created_at']; ?>
                                    </td>
                                    <td style="font-size: 12px">
                                      <?php echo $key['editor']; ?> / <span><?php echo $key['updated_at']; ?>
                                    </td>
                                    <td style="text-align: center;"><?php echo ($key['estado'] == 'A') ? 'Activo' : 'Inactivo'; ?>
                                    </td>
                                    <td>
                                      <button class="btn btn-sm btn-info" onclick="formulario(<?php echo $key['id']; ?>,<?php echo $key['subservicio_id']; ?>)"><i class="fa fa-edit"></i></button>
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
                    </div>

                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->

                </section>


              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                <section class="content">

                  <!-- Default box -->
                  <div class="card card-solid">
                    <div class="card-header">
                        <div class="card-tools">
                            <button class="btn btn-sm btn-info" id="btnNuevo1"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                      <div class="row">
                       <?php if (count($detalle_procesos) > 0) : ?>
                          <?php foreach ($detalle_procesos as $key1) : ?>
                        <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                          <div class="card bg-light d-flex flex-fill">
                            <div class="card-body pt-0">
                              <div class="row" style="margin-top:20px">
                                <div class="col-7">
                                  <h2 class="lead"><b><?php echo $key1['titulo_principal']; ?></b></h2>
                                  <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-check"></i></span> {!! trans('messages.estado') !!}: 
                                    <?php
                                            if($key1['estado']=='A'){

                                                 echo "<span class='right badge badge-success'> Activo </span>";

                                            }else{

                                                echo "<span class='right badge badge-danger'> Inactivo </span>";
                                            }
                                       ?>

                                    </li>
                                  </ul>
                                </div>
                                <div class="col-5 text-center">
                                  <img src="<?php echo env('APP_ADMIN') . "" . $key1['icono']; ?>" class="img-fluid">
                                </div>
                              </div>
                            </div>
                            <div class="card-footer">
                              <div class="text-right">
                                <a href="{{ url('proceso_final', ['id' => $key1->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-tag"></i> Detalle</a>
                                <button class="btn btn-sm btn-success" onclick="formulario1(<?php echo $key1['id']; ?>,<?php echo $key1['subservicio_id']; ?>)"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-sm btn-danger" onclick="eliminar_procesos(<?php echo $key1['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>
                  <?php endforeach; ?>
                  <?php endif; ?>

                      </div>
                    </div>

                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->

                </section>
              </div>
              <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">
              <section class="content" style="margin-top: 30px">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Infografías</h3>

                            <div class="card-tools">
                              <button class="btn btn-sm btn-light" id="btnNuevo"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th style="font-size: 12px;">Titulo</th>
                                  <th style="font-size: 12px;">Infografía</th>
                                  <th style="font-size: 12px;">{!! trans('messages.creadopor') !!}</th>
                                  <th style="font-size: 12px;">{!! trans('messages.estado') !!}</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
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
              <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">
              <section class="content" style="margin-top: 30px">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Videos</h3>

                            <div class="card-tools">
                              <button class="btn btn-sm btn-light" id="btnNuevo"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th style="font-size: 12px;">Titulo</th>
                                  <th style="font-size: 12px;">Video</th>
                                  <th style="font-size: 12px;">{!! trans('messages.creadopor') !!}</th>
                                  <th style="font-size: 12px;">{!! trans('messages.estado') !!}</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
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
              <div class="tab-pane fade" id="custom-content-below-preguntas" role="tabpanel" aria-labelledby="custom-content-below-preguntas-tab">
              <section class="content" style="margin-top: 30px">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Preguntas Frecuentes</h3>

                            <div class="card-tools">
                              <button class="btn btn-sm btn-light" id="btnNuevo"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th style="font-size: 12px;">Titulo</th>
                                  <th style="font-size: 12px;">Video</th>
                                  <th style="font-size: 12px;">{!! trans('messages.creadopor') !!}</th>
                                  <th style="font-size: 12px;">{!! trans('messages.estado') !!}</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
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
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                 @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo $data['nombre_subservicio'];  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo $data['nombre_subservicio_ingles'];  ?>  
                   @endif
                 @endforeach 

                </h4>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo $data['nombre_subservicio'];  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo $data['nombre_subservicio_ingles'];  ?>  
                   @endif
                 @endforeach                   
                </h4>
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

<script type="text/javascript">
    var subservicio_id = '<?php echo $subservicio_id; ?>';  
    $(document).ready(function() {

        $('#maintable').DataTable();

        $('#btnNuevo').click(function() {
            formulario();
        });
        $('#btnNuevo1').click(function() {
            formulario1();
        });
    });
/*************** Contenido del servicio ***********************/
    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/contenido_servicio') ?>',
            type: 'POST',
            data: {
                id: id,
                subservicio_id: subservicio_id
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
/*************** Contenido del servicio ***********************/
/*************** Contenido del servicio card de detalle ***********************/
     function formulario1(id = null) {
        $.ajax({
            url: '<?php echo url('/servicio_card_detalle') ?>',
            type: 'POST',
            data: {
                id: id,
                subservicio_id: subservicio_id
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
       function eliminar_procesos(id = null) {

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
                    url: '<?php echo url('/eliminarprocesos') ?>',
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