@extends('layouts.administrador')

@section('content')
 <input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
                  @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo $data['titulo_principal'];  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo $data['titulo_principal_ingles'];  ?>  
                   @endif
                 @endforeach  
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo url('/'); ?>">{!! trans('messages.inicio') !!}</a></li>
              <li class="breadcrumb-item active"><a href="{{url('/servicios')}}">{!! trans('messages.servicioconsular') !!}</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> 
      <div class="card card-solid">
        <div class="card-header">
            <div class="card-tools">
                <button class="btn btn-sm btn-info" id="btnNuevo"><i class="fa fa-plus-circle"></i> {!! trans('messages.nuevo') !!}</button>
            </div>
        </div>
        <div class="card-body pb-0">
        <div class="row">
           <?php if (count($detalle_final) > 0) : ?>
               <?php foreach ($detalle_final as $key) : ?>

          <div class="col-md-12">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-body">
                <!-- post text -->
                <p><?php echo $key['contenido']; ?></p>
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
              <div class="card-footer">
                <div class="text-right">
               <button class="btn btn-sm btn-success"onclick="formulario(<?php echo $key['id']; ?>,<?php echo $key['subservicio_id']; ?>)"><i class="fa fa-edit"></i></button>
                </div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
                  <?php endforeach; ?>
                  <?php endif; ?>

          <!-- /.col -->
        </div>
        </div>
      </div>
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                  @foreach (array_keys(config('locale.languages')) as $lang)
                    @if ($lang != App::getLocale() AND $lang == 'en')
                       <?php echo $data['titulo_principal'];  ?> 
                           @elseif ($lang != App::getLocale() AND $lang == 'es')
                       <?php echo $data['titulo_principal_ingles'];  ?>  
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
<script type="text/javascript">
    var subserviciofinal_id = '<?php echo $subserviciofinal_id; ?>';  
    $(document).ready(function() {

        $('#maintable').DataTable();

        $('#btnNuevo').click(function() {
            formulario();
        });
    });
/*************** Contenido del servicio ***********************/
    function formulario(id = null) {
        $.ajax({
            url: '<?php echo url('/contenido_final') ?>',
            type: 'POST',
            data: {
                id: id,
                subserviciofinal_id: subserviciofinal_id
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

</script>
@endsection