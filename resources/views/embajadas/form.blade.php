<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
        <img onclick="$('#imagen').trigger('click');" src="<?php echo ($data && !empty($data['imagen'])) ? url('/') . $data['imagen'] : asset('archivos/embajadas/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 135px;height: 90px;" class="imgpreview">
        <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 135px * 90px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
        <input type="file" id="imagen" name="imagen" style="display: none;">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">País</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['pais'] : ''; ?>"  id="pais" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Embajador(a)</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['embajador'] : ''; ?>"  id="embajador" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Concurren</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['concurren'] : ''; ?>"  id="concurren" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Direccion</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['direccion'] : ''; ?>"  id="direccion" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Télefono</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['telefono'] : ''; ?>"  id="telefono" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Sitio Web</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['web'] : ''; ?>"  id="web" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-3">
        <label style="font-size: 12px;font-weight: bold;">Correo Electrónico</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['correo'] : ''; ?>"  id="correo" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-3">
        <label style="font-size: 12px;font-weight: bold;">Twitter</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['twitter'] : ''; ?>"  id="twitter" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-3">
        <label style="font-size: 12px;font-weight: bold;">Instagram</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['instagram'] : ''; ?>"  id="instagram" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-3">
        <label style="font-size: 12px;font-weight: bold;">Facebook</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['facebook'] : ''; ?>"  id="facebook" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Latitud</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['lat'] : ''; ?>"  id="lat" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Longitud</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['lng'] : ''; ?>"  id="lng" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Estado</label>
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
    $("#imagen").change(function() {

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

        if ($('#imagen_etten').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Imagen es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        var formData = new FormData();
        
        formData.append('id', $('#id').val());

        formData.append('imagen_etten', $('#imagen_etten').val());

        var files = $('#imagen_etten').get(0).files;
        formData.append('imagen_etten', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-etten') ?>',
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