<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#img_video').trigger('click');" src="<?php echo ($data && !empty($data['img_video'])) ? url('/') . $data['img_video'] : asset('archivos/campanavideo/video.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 300px;height: 168px;" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 300px * 168px | Peso Max. 2MB <br> Formato: JPG o PNG</p>
    <input type="file" id="img_video" name="img_video" style="display: none;">
    </div>


    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Título</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>" maxlength="100" id="titulo" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Video</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['url_video'] : ''; ?>"  id="url_video" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Estatus<span style="color: red;">*</span></label>
        <select class="form-control form-select" aria-label="estado" id="estado">
            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>Activo</option>
            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>Inactivo</option>
        </select>
    </div>

    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
        $("#img_video").change(function() {

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
                title: "¡El campo código es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#url_video').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Video es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        var formData = new FormData();
        
        formData.append('id', $('#id').val());
        formData.append('titulo', $('#titulo').val());
        formData.append('url_video', $('#url_video').val());
        formData.append('estado', $('#estado').val());
        
        formData.append('img_video', $('#img_video').val());

        var files = $('#img_video').get(0).files;
        formData.append('img_video', files[0]);

        $.ajax({
            url: '<?php echo url('/guardarcvideos') ?>',
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