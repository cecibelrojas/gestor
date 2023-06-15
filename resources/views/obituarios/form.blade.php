<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
        <img onclick="$('#foto_aviso').trigger('click');" src="<?php echo ($data && !empty($data['foto_aviso'])) ? url('/') . $data['foto_aviso'] : asset('archivos/impresos/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 230px;height: 286px;" class="imgpreview">
        <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 230px * 286px | Peso Max. 2MB <br> Formato: JPG o PNG</p>
        <input type="file" id="foto_aviso" name="foto_aviso" style="display: none;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Título <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>"  id="titulo" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Fecha<span style="color: red;">*</span></label>
        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['fecha'] : ''; ?>" id="fecha" style="border: 1px solid #b9b9b9;">
    </div>

    <div class="col-lg-6">
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
    $("#foto_aviso").change(function() {

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
                title: "¡El campo titulo es requerido!",
                showConfirmButton: true
            });
            return false;
        }


        var formData = new FormData();
        
        formData.append('id', $('#id').val());
        formData.append('titulo', $('#titulo').val());
        formData.append('fecha', $('#fecha').val());
        formData.append('estado', $('#estado').val());

        formData.append('foto_aviso', $('#foto_aviso').val());

        var files = $('#foto_aviso').get(0).files;
        formData.append('foto_aviso', files[0]);


        $.ajax({
            url: '<?php echo url('/guardarobituario') ?>',
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