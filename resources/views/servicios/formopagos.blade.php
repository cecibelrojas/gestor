<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="detalleservicio_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="subservicio_id" value="<?php echo $subservicio_id; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#imgpago').trigger('click');" src="<?php echo ($data && !empty($data['imgpago'])) ? url('/') . $data['imgpago'] : asset('archivos/oficinas_detalleservicio/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 40%" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 1600px * 1100px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="imgpago" name="imgpago" style="display: none;">
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
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulopago'] : ''; ?>" maxlength="255" id="titulopago" style="border: 1px solid #b9b9b9;">
				    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
                        <textarea class="form-control summernote" id="despago" rows="3" required><?php echo $data ? $data['despago'] : ''; ?></textarea>
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Alerta métodos de pago Nacional</label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['infopagos'] : ''; ?>" maxlength="300" id="infopagos" style="border: 1px solid #b9b9b9;">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Alerta métodos de pago Internacional</label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['infopagos1'] : ''; ?>" maxlength="300" id="infopagos1" style="border: 1px solid #b9b9b9;">
                    </div>

				</div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-videoin" role="tabpanel" aria-labelledby="custom-content-below-videoin-tab">
				 <div class="row">   
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Title</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulopago_ingles'] : ''; ?>" maxlength="255" id="titulopago_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
                        <textarea class="form-control summernote" id="despago_ingles" rows="3" required><?php echo $data ? $data['despago_ingles'] : ''; ?></textarea>
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Payment methods alert National</label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['infopagos_ingles'] : ''; ?>" maxlength="300" id="infopagos_ingles" style="border: 1px solid #b9b9b9;">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Payment methods alert International</label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['infopagos1_ingles'] : ''; ?>" maxlength="300" id="infopagos1_ingles" style="border: 1px solid #b9b9b9;">
                    </div>

				</div>
              </div>
             </div> 
             <div class="row">
                <div class="col-lg-12 text-right">
                    <hr>
                    <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
                </div>
            </div>
<script>
            $(".summernote").summernote({
            height: 200,
            onImageUpload: function(files){

            for(var i = 0; i < files.length; i++){

                upload_sm(files[i]);

            }

        }

        });


        $("#imgpago").change(function() {

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
        
        if ($('#titulopago').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Título es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#despago').val() == '') {
            swal({
                type: "info",
                title: "¡El campo descripción es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#infopagos').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Alerta métodos de pago Nacional es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#infopagos1').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Alerta métodos de pago Internacional es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        var formData = new FormData();
        
        formData.append('id', $('#detalleservicio_id').val());
        formData.append('subservicio_id', $('#subservicio_id').val());
        formData.append('titulopago', $('#titulopago').val());
        formData.append('titulopago_ingles', $('#titulopago_ingles').val());
        formData.append('despago', $('#despago').val());
        formData.append('despago_ingles', $('#despago_ingles').val());
        formData.append('infopagos', $('#infopagos').val());
        formData.append('infopagos_ingles', $('#infopagos_ingles').val());
        formData.append('infopagos1', $('#infopagos1').val());
        formData.append('infopagos1_ingles', $('#infopagos1_ingles').val());
        formData.append('linkpago', $('#linkpago').val());
        formData.append('imgpago', $('#imgpago').val());

        var files = $('#imgpago').get(0).files;
        formData.append('imgpago', files[0]);

        $.ajax({
            url: '<?php echo url('/pagosconsul-subservicio') ?>',
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
