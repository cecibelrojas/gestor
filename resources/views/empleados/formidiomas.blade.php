<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="idioma_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="canciller_id" value="<?php echo $canciller_id; ?>">

<div class="row">
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Idioma<span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['idioma'] : ''; ?>" id="idioma" style="border: 1px solid #b9b9b9;" placeholder="Idioma">
    </div>

    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    $('#btnSave').click(function() {     

        if ($('#idioma').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Idioma es requerido!",
                showConfirmButton: true
            });
            return false;
        }
             $.ajax({
            url: '<?php echo url('/guardar-idioma') ?>',
            type: 'POST',
            data: {
                id: $('#idioma_id').val(),
                canciller_id: $('#canciller_id').val(),
                idioma: $('#idioma').val()
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