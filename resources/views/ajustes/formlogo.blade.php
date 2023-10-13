<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#img3').trigger('click');" src="<?php echo ($data && !empty($data['img3'])) ? url('/') . $data['img3'] : asset('archivos/logo/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;" class="imgpreview" width="100%">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 640px * 100px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="img3" name="img3" style="display: none;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.url') !!}</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['url'] : ''; ?>" id="url" style="border: 1px solid #b9b9b9;" placeholder="Url del banner">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.estado') !!}</label>
        <select class="form-control form-select" aria-label="estado2" id="estado2">
            <option value="">{!! trans('messages.seleccionar') !!}</option>
            <option value="A" <?php if ($data && 'A' == $data['estado2']) { ?> selected <?php } ?>>{!! trans('messages.activo') !!}</option>
            <option value="I" <?php if ($data && 'I' == $data['estado2']) { ?> selected <?php } ?>>{!! trans('messages.inactivo') !!}</option>
        </select>
        
    </div>

    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
    </div>
</div>
<script>

        $("#img3").change(function() {

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


        var formData = new FormData();
        
        formData.append('id', $('#id').val());
        formData.append('estado2', $('#estado2').val());
        formData.append('url', $('#url').val());
        formData.append('img3', $('#img3').val());

        var files = $('#img3').get(0).files;
        formData.append('img3', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-logoprincipal') ?>',
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