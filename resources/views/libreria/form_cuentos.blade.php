<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
        <img src="<?php echo ($data && !empty($data['foto_impreso'])) ? url('/') . $data['foto_impreso'] : asset('archivos/impresos/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 230px;height: 286px;" class="imgpreview">
        <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 230px * 286px | Peso Max. 2MB <br> Formato: JPG o PNG</p>
        <input type="file" id="foto_impreso" name="foto_impreso" style="display: none;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Título del Impreso <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>" maxlength="50" id="titulo" style="border: 1px solid #b9b9b9;" disabled>
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Adjuntar PDF <span style="color: red;">*</span></label>
        <input type="file" class="form-control input-sm" value="<?php echo $data ? $data['url'] : ''; ?>" maxlength="100" id="url" style="border: 1px solid #b9b9b9;" disabled>
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Tipo de Impreso <span style="color: red;">*</span></label>
        <select class="form-control form-select" aria-label="tipo" id="tipo" disabled>
            <option value="">Seleccione</option>
            <option value="A" <?php if ($data && 'A' == $data['tipo']) { ?> selected <?php } ?>>Revista ÉpaleCCS</option>
            <option value="B" <?php if ($data && 'B' == $data['tipo']) { ?> selected <?php } ?>>El Especulador Precoz</option>
            <option value="C" <?php if ($data && 'C' == $data['tipo']) { ?> selected <?php } ?>>Especiales</option>
            <option value="D" <?php if ($data && 'D' == $data['tipo']) { ?> selected <?php } ?>>Libros</option>
        </select>
    </div>
    @if ($data && $data["estado"] != "")
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Estatus<span style="color: red;">*</span></label>
        <select class="form-control form-select" aria-label="estado" id="estado" disabled>
            <option value="">Seleccione</option>
            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>Activo</option>
            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>Inactivo</option>
        </select>
    </div>
    @endif
</div>
<script>
    $("#foto_impreso").change(function() {

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

        formData.append('titulo', $('#titulo').val());
        formData.append('url', $('#url').val());
        formData.append('tipo', $('#tipo').val());

        formData.append('foto_impreso', $('#foto_impreso').val());

        var files = $('#foto_impreso').get(0).files;
        formData.append('foto_impreso', files[0]);

        var filespdf = $('#url').get(0).files;
        formData.append('url', filespdf[0]);

        $.ajax({
            url: '<?php echo url('/guardar-impreso') ?>',
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