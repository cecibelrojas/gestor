<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Título del Video</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>" maxlength="100" id="titulo" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">URL del video <span>Ejemp: https://www.youtube.com/watch?v=<b style="color: red;">iywaBOMvYLI </b></span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['link'] : ''; ?>" maxlength="100" id="link" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    $('#btnSave').click(function() {

        if ($('#titulo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo titulo es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#link').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Extracto de URL del video es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardar-video') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                titulo: $('#titulo').val(),
                link: $('#link').val(),
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