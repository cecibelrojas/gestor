<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="col-lg-12 text-center">
    <img onclick="$('#foto').trigger('click');" src="<?php echo ($data && !empty($data['foto'])) ? url('/') . $data['foto'] : asset('archivos/empleado/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 200px;height: 200px;" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 400px * 400px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="foto" name="foto" style="display: none;">
</div>
<div class="row">
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Nombres <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombres'] : ''; ?>" id="nombres" style="border: 1px solid #b9b9b9;" placeholder="Nombres">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Apellidos <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['apellidos'] : ''; ?>" id="apellidos" style="border: 1px solid #b9b9b9;" placeholder="Apellidos">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Sexo <span style="color: red;">*</span></label>
        <select class="form-control form-select" aria-label="sexo" id="sexo">
            <option value="">Seleccione</option>
            <option value="F" <?php if ($data && 'F' == $data['sexo']) { ?> selected <?php } ?>>Femenino</option>
            <option value="M" <?php if ($data && 'M' == $data['sexo']) { ?> selected <?php } ?>>Masculino</option>
        </select>
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Cargo <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['cargo'] : ''; ?>" id="cargo" style="border: 1px solid #b9b9b9;" placeholder="Cargo">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Tipo <span style="color: red;">*</span></label>
        <select class="form-control form-select" aria-label="tipo" id="tipo">
            <option value="">Seleccione</option>
            <option value="A" <?php if ($data && 'A' == $data['tipo']) { ?> selected <?php } ?>>Ministro(a)</option>
            <option value="B" <?php if ($data && 'B' == $data['tipo']) { ?> selected <?php } ?>>Viceministro(a)</option>
        </select>
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Estado</label>
        <select class="form-control form-select" aria-label="estado" id="estado">
            <option value="">Seleccione</option>
            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>Activo</option>
            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>Inactivo</option>
        </select>
    </div>

    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Resumen<span style="color: red;">*</span></label>
        <textarea class="form-control" id="resumen" rows="5"><?php echo $data ? $data['resumen'] : ''; ?></textarea>
    </div>
   
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
        $("#foto").change(function() {

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

        if ($('#nombres').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Nombres es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#apellidos').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Apellidos es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#sexo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo sexo es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#cargo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Cargo es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#tipo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Tipo es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#estado').val() == '') {
            swal({
                type: "info",
                title: "¡El campo estado es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#resumen').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Resumen es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        var formData = new FormData();

        formData.append('id', $('#id').val());
        formData.append('nombres', $('#nombres').val());
        formData.append('apellidos', $('#apellidos').val());
        formData.append('sexo', $('#sexo').val());        
        formData.append('cargo', $('#cargo').val());
        formData.append('tipo', $('#tipo').val());
        formData.append('resumen', $('#resumen').val());
        formData.append('estado', $('#estado').val());

        formData.append('foto', $('#foto').val());

        var files = $('#foto').get(0).files;
        formData.append('foto', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-empleado') ?>',
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