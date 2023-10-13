<input type="hidden" id="detalleservicio_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="subservicio_id" value="<?php echo $subservicio_id; ?>">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-prueba-tab" data-toggle="pill" href="#custom-content-below-prueba" role="tab" aria-controls="custom-content-below-prueba" aria-selected="true">{{ __("Spanish") }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-dato-tab" data-toggle="pill" href="#custom-content-below-dato" role="tab" aria-controls="custom-content-below-dato" aria-selected="false"> {{ __("English") }}</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-prueba" role="tabpanel" aria-labelledby="custom-content-below-prueba-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Título Principal<span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_principal'] : ''; ?>" id="titulo_principal" name="titulo_principal" style="border: 1px solid #b9b9b9;" placeholder="Título principal">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    <textarea id="descripcion_servicio" class="summernote" name="descripcion_servicio">{{ @$data->descripcion_servicio }}</textarea>
                    </div>

                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.estado') !!}</label>
                        <select class="form-control form-select" aria-label="estado" id="estado">
                            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>{!! trans('messages.activo') !!}</option>
                            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>{!! trans('messages.inactivo') !!}</option>
                        </select>
                    </div>   
                </div>


              </div>
              <div class="tab-pane fade" id="custom-content-below-dato" role="tabpanel" aria-labelledby="custom-content-below-dato-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Título Principal<span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_principal_ingles'] : ''; ?>" id="titulo_principal_ingles" name="titulo_principal_ingles" style="border: 1px solid #b9b9b9;" placeholder="Título principal">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    <textarea id="descripcion_servicio_ingles" class="summernote" name="descripcion_servicio_ingles">{{ @$data->descripcion_servicio_ingles }}</textarea>
                    </div>

                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.estado') !!}</label>
                        <select class="form-control form-select" aria-label="estado" id="estado">
                            <option value="">Seleccione</option>
                            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>{!! trans('messages.activo') !!}</option>
                            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>{!! trans('messages.inactivo') !!}</option>
                        </select>
                    </div>   
                </div>


              </div>
                    <div class="col-lg-12 text-right">
                        <hr>
                        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
                    </div>
            </div>

<script>
$('.summernote').summernote()
    $('#btnSave').click(function() {

        if ($('#titulo_principal').val() == '') {
            swal({
                type: "info",
                title: "¡El campo es requerido!",
                showConfirmButton: true
            });
            return false;
        }

             $.ajax({
            url: '<?php echo url('/guardar-contenidoservicio') ?>',
            type: 'POST',
            data: {
                id: $('#detalleservicio_id').val(),
                subservicio_id: $('#subservicio_id').val(),
                titulo_principal: $('#titulo_principal').val(),
                titulo_principal_ingles: $('#titulo_principal_ingles').val(),
                descripcion_servicio: $('#descripcion_servicio').val(),
                descripcion_servicio_ingles: $('#descripcion_servicio_ingles').val(),
                estado: $('#estado').val()
            },
            beforeSend: function() {
                $('#btnSave').html("Procesando <i class='fa fa-spinner fa-pulse'></i>").attr('disabled', true);
            },
            success: function(data) {

                if (typeof data.errorMessage != 'undefined') {
                    swal({
                        icon: 'error',
                        text: data.errorMessage,
                        showConfirmButton: true
                    });
                    $('#btnSave').html("Guardar Cambios").attr('disabled', false);
                    return false;
                }

                swal({
                    icon: 'success',
                    title: '¡Exito!',
                    text: 'Se han guardado los cambios realizados.',
                    showConfirmButton: true
                }).then(function(result) {
                    location.reload();
                });
            },
            error: function() {
                $('#btnSave').html("Guardar Cambios").attr('disabled', false);
            }
        });
    });
        tinymce.init({
      selector: '#descripcion_servicio',
      height: 300,
      menubar: false,
      plugins: [
        'advlist autolink lists charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>