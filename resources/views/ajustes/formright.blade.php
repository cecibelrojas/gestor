<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#img2').trigger('click');" src="<?php echo ($data && !empty($data['img2'])) ? url('/') . $data['img2'] : asset('archivos/institucional1/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 104px;height: 90px;" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 150px * 90px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="img2" name="img2" style="display: none;">
    </div>
        <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.estado') !!}</label>
        <select class="form-control form-select" aria-label="estado1" id="estado1">
            <option value="">{!! trans('messages.seleccionar') !!}</option>
            <option value="A" <?php if ($data && 'A' == $data['estado1']) { ?> selected <?php } ?>>{!! trans('messages.activo') !!}</option>
            <option value="I" <?php if ($data && 'I' == $data['estado1']) { ?> selected <?php } ?>>{!! trans('messages.inactivo') !!}</option>
        </select>
    </div>
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
    </div>
</div>
<script>
        $("#img2").change(function() {

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
        formData.append('estado1', $('#estado1').val());
        formData.append('img2', $('#img2').val());

        var files = $('#img2').get(0).files;
        formData.append('img2', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-logoright') ?>',
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