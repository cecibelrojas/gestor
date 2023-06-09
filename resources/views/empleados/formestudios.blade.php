<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="estuido_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="canciller_id" value="<?php echo $canciller_id; ?>">

<div class="row">
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Institutión/Universidad <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre_institucion'] : ''; ?>" id="nombre_institucion" style="border: 1px solid #b9b9b9;" placeholder="Universidad">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Título <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>" id="titulo" style="border: 1px solid #b9b9b9;" placeholder="Título">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Lugar <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['lugar'] : ''; ?>" id="lugar" style="border: 1px solid #b9b9b9;" placeholder="Lugar de Estudio">
    </div>

       <div class="col-lg-3">
        <label style="font-size: 12px;font-weight: bold;">Año Inicio <span style="color: red;">*</span></label>
        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['ano_inicio'] : ''; ?>" id="ano_inicio" style="border: 1px solid #b9b9b9;" >
    </div>
    <div class="col-lg-3">
        <label style="font-size: 12px;font-weight: bold;">Año Fin <span style="color: red;">*</span></label>
        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['ano_fin'] : ''; ?>" id="ano_fin" style="border: 1px solid #b9b9b9;" >
    </div>

    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    $('#btnSave').click(function() {     

        if ($('#nombre_institucion').val() == '') {
            swal({
                type: "info",
                title: "¡El campo nombre es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#titulo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Título es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#lugar').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Lugar es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#ano_inicio').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Año Inicio es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#ano_fin').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Año Fin es requerido!",
                showConfirmButton: true
            });
            return false;
        }
             $.ajax({
            url: '<?php echo url('/guardar-estudios') ?>',
            type: 'POST',
            data: {
                id: $('#estuido_id').val(),
                canciller_id: $('#canciller_id').val(),
                nombre_institucion: $('#nombre_institucion').val(),
                titulo: $('#titulo').val(),
                lugar: $('#lugar').val(),
                ano_inicio: $('#ano_inicio').val(),
                ano_fin: $('#ano_fin').val()
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