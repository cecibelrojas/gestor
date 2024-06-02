<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="detalleservicio_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="subservicio_id" value="<?php echo $subservicio_id; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#imgextra').trigger('click');" src="<?php echo ($data && !empty($data['imgextra'])) ? url('/') . $data['imgextra'] : asset('archivos/oficinas_detalleservicio/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 40%" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 1094px * 350px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="imgextra" name="imgextra" style="display: none;">
    </div>
</div>
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#imgfaq').trigger('click');" src="<?php echo ($data && !empty($data['imgfaq'])) ? url('/') . $data['imgfaq'] : asset('archivos/oficinas_detalleservicio/img1.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 40%" class="imgpreview1">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 900px * 670px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="imgfaq" name="imgfaq" style="display: none;">
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
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['textoextra'] : ''; ?>" maxlength="255" id="textoextra" style="border: 1px solid #b9b9b9;">
				    </div>
				</div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-videoin" role="tabpanel" aria-labelledby="custom-content-below-videoin-tab">
				 <div class="row">   
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Title</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['textoextra_ingles'] : ''; ?>" maxlength="255" id="textoextra_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
				</div>
              </div>
             </div> 
             <div class="row">
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Botón</label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['link3'] : ''; ?>" maxlength="255" id="link3" style="border: 1px solid #b9b9b9;">
                    </div>
                <div class="col-lg-12 text-right">
                    <hr>
                    <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
                </div>
            </div>
<script>

        $("#imgextra").change(function() {

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
    $("#imgfaq").change(function() {

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

            $(".imgpreview1").attr("src", rutaImagen);

        })
    })    
    $('#btnSave').click(function() {
        
        if ($('#textoextra').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Título es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#link3').val() == '') {
            swal({
                type: "info",
                title: "¡El campo descripción es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        var formData = new FormData();
        
        formData.append('id', $('#detalleservicio_id').val());
        formData.append('subservicio_id', $('#subservicio_id').val());
        formData.append('textoextra', $('#textoextra').val());
        formData.append('textoextra_ingles', $('#textoextra_ingles').val());
        formData.append('link3', $('#link3').val());
        formData.append('imgextra', $('#imgextra').val());
        formData.append('imgfaq', $('#imgfaq').val());

        var files = $('#imgextra').get(0).files;
        formData.append('imgextra', files[0]);

        var files1 = $('#imgfaq').get(0).files;
        formData.append('imgfaq', files1[0]);

        $.ajax({
            url: '<?php echo url('/extrasconsul-subservicio') ?>',
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
