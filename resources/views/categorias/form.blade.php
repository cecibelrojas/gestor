<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">  
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Nombre</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre'] : ''; ?>" maxlength="100" id="nombre" style="border: 1px solid #b9b9b9;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Descripción</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['descripcion'] : ''; ?>" maxlength="255" id="descripcion" style="border: 1px solid #b9b9b9;">
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
                title: "¡El campo nombre es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardarcategoria') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),                
                nombre: $('#nombre').val(),
                descripcion: $('#descripcion').val()
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