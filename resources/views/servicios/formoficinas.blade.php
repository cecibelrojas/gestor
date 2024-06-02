<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="detalleservicio_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="subservicio_id" value="<?php echo $subservicio_id; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#imgmap').trigger('click');" src="<?php echo ($data && !empty($data['imgmap'])) ? url('/') . $data['imgmap'] : asset('archivos/oficinas_detalleservicio/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 40%" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 1600px * 1100px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="imgmap" name="imgmap" style="display: none;">
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
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulomap'] : ''; ?>" maxlength="255" id="titulomap" style="border: 1px solid #b9b9b9;">
				    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
                        <textarea class="form-control summernote" id="desmapa" rows="3" required><?php echo $data ? $data['desmapa'] : ''; ?></textarea>
                    </div>
				</div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-videoin" role="tabpanel" aria-labelledby="custom-content-below-videoin-tab">
				 <div class="row">   
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Title</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulomap_ingles'] : ''; ?>" maxlength="255" id="titulomap_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
                        <textarea class="form-control summernote" id="desmapa_ingles" rows="3" required><?php echo $data ? $data['desmapa_ingles'] : ''; ?></textarea>
                    </div>

				</div>
              </div>
             </div> 
             <div class="row">
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Botón 1 Nacional</label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['linkna'] : ''; ?>" maxlength="255" id="linkna" style="border: 1px solid #b9b9b9;">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Botón 2 Internacional</label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['linkin'] : ''; ?>" maxlength="255" id="linkin" style="border: 1px solid #b9b9b9;">
                    </div>

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


        $("#imgmap").change(function() {

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
        
        if ($('#titulomap').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Título es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#desmapa').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Descripción es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        var formData = new FormData();
        
        formData.append('id', $('#detalleservicio_id').val());
        formData.append('subservicio_id', $('#subservicio_id').val());
        formData.append('titulomap', $('#titulomap').val());
        formData.append('titulomap_ingles', $('#titulomap_ingles').val());
        formData.append('desmapa', $('#desmapa').val());
        formData.append('desmapa_ingles', $('#desmapa_ingles').val());
        formData.append('linkna', $('#linkna').val());
        formData.append('linkin', $('#linkin').val());
        
        formData.append('imgmap', $('#imgmap').val());

        var files = $('#imgmap').get(0).files;
        formData.append('imgmap', files[0]);

        $.ajax({
            url: '<?php echo url('/oficinasconsul-subservicio') ?>',
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
