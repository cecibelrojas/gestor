@extends('layouts.administrador')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{!! trans('messages.header') !!}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
                    <li class="breadcrumb-item active">{!! trans('messages.header') !!}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <section class="content">
<?php if (count($lista1) > 0) : ?>
    <?php foreach ($lista1 as $key) : ?>
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  {!! trans('messages.logoleft') !!}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <img src="<?php echo env('APP_ADMIN') . "" . $key['img1']; ?>" class="imgpreview" width="100%">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-sm btn-info" onclick="formulario(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  {!! trans('messages.logoright') !!}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <img src="<?php echo env('APP_ADMIN') . "" . $key['img2']; ?>" class="imgpreview"  height="100%">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-sm btn-info" onclick="formulario1(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  {!! trans('messages.logoprincipal') !!}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <img src="<?php echo env('APP_ADMIN') . "" . $key['img3']; ?>" class="imgpreview" width="100%">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-sm btn-info" onclick="formulario2(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    <?php endforeach; ?>
<?php endif; ?> 
    </section>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{!! trans('messages.ajustecolor') !!}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- /.content-header -->

    <section class="content">
<?php if (count($lista2) > 0) : ?>
    <?php foreach ($lista2 as $key) : ?>
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Header
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                        <div class="color-palette-set">
                          <div class="color-palette" style="background-color:<?php echo $key['colorh']; ?>"><span><?php echo $key['colorh']; ?></span></div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-sm btn-info" onclick="formulario3(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Top Bar
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                        <div class="color-palette-set">
                          <div class="color-palette" style="background-color:<?php echo $key['colort']; ?>"><span><?php echo $key['colort']; ?></span></div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="btn btn-sm btn-info" onclick="formulario4(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    <?php endforeach; ?>
<?php endif; ?> 
    </section>
<!-- Content Header (Page header) -->
<!-- /.content-header -->
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('messages.logoleft') !!}</h4>
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
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('messages.logoright') !!}</h4>
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
                <h4 class="modal-title">{!! trans('messages.logoprincipal') !!}</h4>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('messages.header') !!}</h4>
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
<div class="modal fade" id="modal-nuevo4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{!! trans('messages.topbar') !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-content4"></div>
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
        $('#btnNuevo2').click(function() {
            formulario2();
        });

    });

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/logoleft') ?>',
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
            url: '<?php echo url('/logoright') ?>',
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
    function formulario2(id = null) {
        $.ajax({
            url: '<?php echo url('/logoprincipal') ?>',
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
    function formulario3(id = null) {
        $.ajax({
            url: '<?php echo url('/colorheader') ?>',
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
     function formulario4(id = null) {
        $.ajax({
            url: '<?php echo url('/colortop') ?>',
            type: 'POST',
            data: {
                id: id
            },
            beforeSend: function() {
                $('#modal-nuevo4').modal('show');
                $('#form-content4').html("Cargando <i class='fa fa-spinner fa-pulse'></i>");
            },
            success: function(view) {
                $('#form-content4').html(view);
            },
            error: function() {
                $('#form-content4').html("Error al cargar ventana.");
            }
        });
    }   
</script>    
@endsection