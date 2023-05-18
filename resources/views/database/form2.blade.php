<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id2" value="<?php echo $id; ?>">
<input type="hidden" id="accion" value="<?php echo $accion; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-4">
        <label style="font-size: 12px;font-weight: bold;">Codigo</label>
        <input type="text" class="form-control input-sm" maxlength="3" value="<?php echo $data ? $data['item'] : ''; ?>" maxlength="20" id="item" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-8">
        <label style="font-size: 12px;font-weight: bold;">Nombre</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre'] : ''; ?>" maxlength="100" id="nombre2" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave2" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    $('#btnSave2').click(function() {

        if ($('#codigo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo código es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#nombre').val() == '') {
            swal({
                type: "info",
                title: "¡El campo nombre es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardar-detalle') ?>',
            type: 'POST',
            data: {
                id: $('#id2').val(),
                item: $('#item').val(),
                nombre: $('#nombre2').val(),
                accion: $('#accion').val()
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
                    //location.reload();
                    filtrar2();
                    $('#modal-nuevo2').modal('hide');
                });
            },
            error: function() {
                $('#btnSave').html("Guardar Cambios").attr('disabled', false);
            }
        });
    });
</script>