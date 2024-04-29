<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="detalleservicio_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="subservicio_id" value="<?php echo $subservicio_id; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#infografia').trigger('click');" src="<?php echo ($data && !empty($data['infografia'])) ? url('/') . $data['infografia'] : asset('archivos/infografia_detalleservicio/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 40%" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 500px * 350px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="infografia" name="infografia" style="display: none;">
    </div>
</div>
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
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.titulo') !!}</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>" maxlength="255" id="titulo" style="border: 1px solid #b9b9b9;">
				    </div>
				</div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-videoin" role="tabpanel" aria-labelledby="custom-content-below-videoin-tab">
				 <div class="row">   
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Title</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_ingles'] : ''; ?>" maxlength="255" id="titulo_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
				</div>
              </div>
             </div> 
             <div class="row">
				<div class="col-lg-10">
					    <label style="font-size: 12px;font-weight: bold;">Estado<span style="color: red;">*</span></label>
					    <select class="form-control form-select" aria-label="estado" id="estado">
					        <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>Activo</option>
					        <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>Inactivo</option>
					    </select>
				</div>
                    <div class="col-lg-2">
                        <label style="font-size: 12px;font-weight: bold;">Orden</label>
                        <input type="number" class="form-control input-sm" value="<?php echo $data ? $data['orden'] : ''; ?>" maxlength="2" id="orden" style="border: 1px solid #b9b9b9;">
                    </div>
                <div class="col-lg-12 text-right">
                    <hr>
                    <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
                </div>
            </div>
<script>
        $("#infografia").change(function() {

        var imagen = this.files[0];
        var documento = this.files[0];
        var tipo = $(this).attr("name");

        /*=============================================
        VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
        =============================================*/


        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {

            var rutaImagen = event.target.result;

            $(".imgpreview").attr("src", rutaImagen);

        })
    })
    $('#btnSave').click(function() {
        
        if ($('#titulo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Título es requerido!",
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
        formData.append('titulo_ingles', $('#titulo_ingles').val());
        formData.append('estado', $('#estado').val());
        formData.append('orden', $('#orden').val());
        formData.append('infografia', $('#infografia').val());

        var files = $('#infografia').get(0).files;
        formData.append('infografia', files[0]);

        $.ajax({
            url: '<?php echo url('/infografia-subservicio') ?>',
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
