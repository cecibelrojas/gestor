<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="trabajo_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="canciller_id" value="<?php echo $canciller_id; ?>">

<div class="row">
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Empresa<span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" maxlength="200" value="<?php echo $data ? $data['empresa'] : ''; ?>" id="empresa" style="border: 1px solid #b9b9b9;" placeholder="Empresa">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Cargo <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" maxlength="200" value="<?php echo $data ? $data['cargo'] : ''; ?>" id="cargo" style="border: 1px solid #b9b9b9;" placeholder="Cargo">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Lugar <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['lugar'] : ''; ?>" id="lugar" style="border: 1px solid #b9b9b9;" placeholder="Ubicación">
    </div>

    <div class="col-lg-3">
        <label style="font-size: 12px;font-weight: bold;">Año Inicio <span style="color: red;">*</span></label>
        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['fecha_inicio'] : ''; ?>" id="fecha_inicio" style="border: 1px solid #b9b9b9;" >
    </div>
    <div class="col-lg-3">
        <label style="font-size: 12px;font-weight: bold;">Año Fin <span style="color: red;">*</span></label>
        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['fecha_fin'] : ''; ?>" id="fecha_fin" style="border: 1px solid #b9b9b9;" >
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Detalles Laborales <span style="color: red;">*</span></label>
        <textarea id="detalle"  class="summernote" style="height: 400px">
               <?php echo $data ? $data['detalle'] : ''; ?> 
        </textarea>


    </div>



    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    $('.summernote').summernote()
    $('#btnSave').click(function() {     

        if ($('#empresa').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Empresa es requerido!",
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
        if ($('#lugar').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Lugar es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#fecha_inicio').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Fecha Inicio es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#fecha_fin').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Fecha Fin es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#detalle').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Detalles Fin es requerido!",
                showConfirmButton: true
            });
            return false;
        }

             $.ajax({
            url: '<?php echo url('/guardar-empleos') ?>',
            type: 'POST',
            data: {
                id: $('#trabajo_id').val(),
                canciller_id: $('#canciller_id').val(),
                empresa: $('#empresa').val(),
                cargo: $('#cargo').val(),
                lugar: $('#lugar').val(),
                fecha_inicio: $('#fecha_inicio').val(),
                fecha_fin: $('#fecha_fin').val(),
                detalle: $('#detalle').val()
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