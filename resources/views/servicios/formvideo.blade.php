<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="detalleservicio_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="subservicio_id" value="<?php echo $subservicio_id; ?>">
<!-- -->
<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-videoes-tab" data-toggle="pill" href="#custom-content-below-videoes" role="tab" aria-controls="custom-content-below-videoes" aria-selected="true">{{ __("Spanish") }}</a>
              </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-content-below-videoin-tab" data-toggle="pill" href="#custom-content-below-videoin" role="tab" aria-controls="custom-content-below-videoin" aria-selected="false"> {{ __("English") }}</a>
    </li>
</ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-videoes" role="tabpanel" aria-labelledby="custom-content-below-videoes-tab">
				 <div class="row">   
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Pregunta</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>" maxlength="255" id="titulo" style="border: 1px solid #b9b9b9;">
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Respuesta<span style="color: red;">*</span></label>
				        <textarea class="form-control summernote" id="descripcion" rows="3"><?php echo $data ? $data['descripcion'] : ''; ?></textarea>
				    </div>
				</div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-videoin" role="tabpanel" aria-labelledby="custom-content-below-videoin-tab">
				 <div class="row">   
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Ask</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_ingles'] : ''; ?>" maxlength="255" id="titulo_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Answer<span style="color: red;">*</span></label>
				        <textarea class="form-control summernote" id="descripcion_ingles" rows="3"><?php echo $data ? $data['descripcion_ingles'] : ''; ?></textarea>
				    </div>
				</div>
              </div>
             </div> 
              <div class="row">
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Estado<span style="color: red;">*</span></label>
				        <select class="form-control form-select" aria-label="estado" id="estado">
				            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>Activo</option>
				            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>Inactivo</option>
				        </select>
				    </div>
              <div class="col-lg-12 text-right">
                        <hr>
                        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
                    </div>
            </div>
<script>
            $(".summernote").summernote({
            height: 300,
            onImageUpload: function(files){

            for(var i = 0; i < files.length; i++){

                upload_sm(files[i]);

            }

        }

        });
    $('#btnSave').click(function() {
        
        if ($('#titulo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Pregunta es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#descripcion').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Respuesta es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#estado').val() == '') {
            swal({
                type: "info",
                title: "¡El campo estado es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        var formData = new FormData();
        
        formData.append('id', $('#detalleservicio_id').val());
        formData.append('subservicio_id', $('#subservicio_id').val());
        formData.append('titulo', $('#titulo').val());
        formData.append('descripcion', $('#descripcion').val());
        formData.append('titulo_ingles', $('#titulo_ingles').val());
        formData.append('descripcion_ingles', $('#descripcion_ingles').val());
        formData.append('estado', $('#estado').val());

        $.ajax({
            url: '<?php echo url('/guardar-video_subservicio') ?>',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
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
</script>