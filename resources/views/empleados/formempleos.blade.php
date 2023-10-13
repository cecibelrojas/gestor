<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="trabajo_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="canciller_id" value="<?php echo $canciller_id; ?>">
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-prueba-tab" data-toggle="pill" href="#custom-content-below-prueba" role="tab" aria-controls="custom-content-below-prueba" aria-selected="true">{{ __("Spanish") }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-dato-tab" data-toggle="pill" href="#custom-content-below-dato" role="tab" aria-controls="custom-content-below-dato" aria-selected="false"> {{ __("English") }}</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-prueba" role="tabpanel" aria-labelledby="custom-content-below-prueba-tab">
                <div class="row" style="margin-top:20px">
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

                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-dato" role="tabpanel" aria-labelledby="custom-content-below-dato-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Empresa<span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" maxlength="200" value="<?php echo $data ? $data['empresa_ingles'] : ''; ?>" id="empresa_ingles" style="border: 1px solid #b9b9b9;" placeholder="Empresa">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Cargo <span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" maxlength="200" value="<?php echo $data ? $data['cargo_ingles'] : ''; ?>" id="cargo_ingles" style="border: 1px solid #b9b9b9;" placeholder="Cargo">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Lugar <span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['lugar_ingles'] : ''; ?>" id="lugar_ingles" style="border: 1px solid #b9b9b9;" placeholder="Ubicación">
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
                        <textarea id="detalle_ingles"  class="summernote" style="height: 400px">
                               <?php echo $data ? $data['detalle_ingles'] : ''; ?> 
                        </textarea>


                    </div>

                </div>


              </div>
                    <div class="col-lg-12 text-right">
                        <hr>
                        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
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
                empresa_ingles: $('#empresa_ingles').val(),
                cargo: $('#cargo').val(),
                cargo_ingles: $('#cargo_ingles').val(),
                lugar: $('#lugar').val(),
                lugar_ingles: $('#lugar_ingles').val(),
                fecha_inicio: $('#fecha_inicio').val(),
                fecha_fin: $('#fecha_fin').val(),
                detalle: $('#detalle').val(),
                detalle_ingles: $('#detalle_ingles').val()
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