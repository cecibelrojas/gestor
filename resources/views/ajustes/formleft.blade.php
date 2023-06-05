<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#img1').trigger('click');" src="<?php echo ($data && !empty($data['img1'])) ? url('/') . $data['img1'] : asset('archivos/institucional/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 380px;height: 55px;" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 380px * 55px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="img1" name="img1" style="display: none;">
    </div>
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
        $("#img1").change(function() {

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

        var formData = new FormData();
        
        formData.append('id', $('#id').val());

        formData.append('img1', $('#img1').val());

        var files = $('#img1').get(0).files;
        formData.append('img1', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-logoleft') ?>',
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