<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Nombre</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre'] : ''; ?>" id="nombre" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">URL</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['url'] : ''; ?>"  id="url" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Icono</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['icono'] : ''; ?>" id="icono" style="border: 1px solid #b9b9b9;">
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
    $('#btnSave').click(function() {

        if ($('#nombre').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Nombre es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#url').val() == '') {
            swal({
                type: "info",
                title: "¡El campo URL es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#icono').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Icono es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardar-redsocial') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                nombre: $('#nombre').val(),
                url: $('#url').val(),
                icono: $('#icono').val(),
                estado: $('#estado').val()
            },
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