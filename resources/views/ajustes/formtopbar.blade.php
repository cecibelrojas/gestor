<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12">
        <div id="cp3" class="input-group colorpicker-component">
            <input type="text" value="<?php echo $data ? $data['colort'] : ''; ?>" placeholder="#dee0e1" id="colort" name="colort" class="form-control" />
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
    </div>
</div>
<script>
   $(function() {
        $('#cp3').colorpicker();
    });
    $('#btnSave').click(function() {

        $.ajax({
            url: '<?php echo url('/guardar-colortopbar') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                colort: $('#colort').val(),
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