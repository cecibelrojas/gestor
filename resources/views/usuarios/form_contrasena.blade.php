<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<!-- password hiddem -->
<input type="hidden" name="password_actual" value="<?php echo $data ? $data['password'] : ''; ?>">
<!-- password hiddem -->

<div class="row">

    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Contraseña <span style="color: red;">*</span></label>
        <input type="password" class="form-control input-sm" id="password" style="border: 1px solid #b9b9b9;" autocomplete="new-password"  placeholder="Contraseña mínimo de 8 caracteres">
    </div>
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    $('#btnSave').click(function() {

        if ($('#password').val() == '') {
            swal({
                type: "info",
                title: "¡El campo password es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        $.ajax({
            url: '<?php echo url('/guardar-contrasena') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                password: $('#password').val()
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