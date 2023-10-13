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
@endsection