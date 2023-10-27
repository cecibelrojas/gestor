@extends('layouts.administrador')

@section('content')
 <input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
             Detalles del Servicio de Identidad de :
            </h1>
                  @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo '<h5>'. $data['nombre_servicio']."</h5>"  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo '<h5>'. $data['nombre_servicio_ingles']."</h5>"  ?>  
                   @endif
                 @endforeach  
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
              <li class="breadcrumb-item active"><a href="{{url('/servicios_identidad_nacional')}}">{!! trans('messages.servicioidentidad_nacional') !!}</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
<?php if (count($subservicio) > 0) : ?>
    <?php foreach ($subservicio as $key) : ?>
        <div class="card-body pb-0">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Imagen Principal
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <img src="<?php echo env('APP_ADMIN') . "" . $key['imagen_principal']; ?>" onerror="this.src='<?php echo asset('archivos/identidad_nacional/img.png'); ?>'" class="imgpreview" width="100%">
                    </div>
                  </div>
                  <div class="row" style="margin-top:20px">
                    <div class="col-12">
                      	<p><?php echo $key['descripcion']; ?></p>
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
          </div>
        </div>
            <?php endforeach; ?>
        <?php else: ?>
        <div class="card-body pb-0">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Imagen Principal
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-12">
                      <img src="{{asset('archivos/identidad_nacional/img.png')}}" class="imgpreview" width="100%">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php endif; ?> 
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
</section>

    <div class="modal fade" id="modal-nuevo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Imagen Principal</h4>
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
      var identidad_id = '<?php echo $identidad_id; ?>';
    $(document).ready(function() {

        $('#maintable').DataTable();

        $('#btnNuevo').click(function() {
            formulario();
        });

    });

    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/formulario_detalle_identidad') ?>',
            type: 'POST',
            data: {
                id: id,
                identidad_id: identidad_id
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
