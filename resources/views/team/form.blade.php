<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Abreviatura</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['abreviatura'] : ''; ?>" maxlength="10" id="abreviatura" style="border: 1px solid #b9b9b9;text-transform: uppercase;">
    </div>
    <div class="col-lg-8">
        <label style="font-size: 12px;font-weight: bold;">Entidad</label>
        <select id="entidad" class="form-control input-sm">
            <option value="">Seleccionar</option>
            <?php if (count($entidades) > 0) : ?>
                <?php foreach ($entidades as $key) : ?>
                    <option <?php echo ($key['item'] == @$data['entidad']) ? "selected" : ""; ?> value="<?php echo $key['item']; ?>"><?php echo $key['nombre']; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Nombre</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre'] : ''; ?>" maxlength="255" id="nombre" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Ciudad</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['ciudad'] : ''; ?>" maxlength="255" id="ciudad" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Sede</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['sede'] : ''; ?>" maxlength="255" id="sede" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Logo</label>
        <input type="file" class="form-control input-sm" value="<?php echo $data ? $data['logo'] : ''; ?>" id="logo" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    $('#btnSave').click(function() {

        var formData = new FormData();

        if ($('#nombre').val() == '') {
            swal({
                type: "info",
                title: "¡El campo nombre es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#entidad').val() == '') {
            swal({
                type: "info",
                title: "¡El campo entidad es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        formData.append('id', $('#id').val());
        formData.append('abreviatura', $('#abreviatura').val());
        formData.append('nombre', $('#nombre').val());
        formData.append('entidad', $('#entidad').val());
        formData.append('sede', $('#sede').val());
        formData.append('ciudad', $('#ciudad').val());

        var files = $('#logo').get(0).files;
        formData.append('logo', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-equipo') ?>',
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