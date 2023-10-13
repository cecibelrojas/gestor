<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="estuido_id" value="<?php echo $data ? $data['id'] : ''; ?>">
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
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.intitucion_universidad') !!}<span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre_institucion'] : ''; ?>" id="nombre_institucion" style="border: 1px solid #b9b9b9;" placeholder="Universidad">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.titulo') !!} <span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>" id="titulo" style="border: 1px solid #b9b9b9;" placeholder="Título">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.lugar') !!} <span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['lugar'] : ''; ?>" id="lugar" style="border: 1px solid #b9b9b9;" placeholder="Lugar de Estudio">
                    </div>

                       <div class="col-lg-3">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.ano_inicio') !!} <span style="color: red;">*</span></label>
                        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['ano_inicio'] : ''; ?>" id="ano_inicio" style="border: 1px solid #b9b9b9;" >
                    </div>
                    <div class="col-lg-3">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.ano_fin') !!} <span style="color: red;">*</span></label>
                        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['ano_fin'] : ''; ?>" id="ano_fin" style="border: 1px solid #b9b9b9;" >
                    </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-dato" role="tabpanel" aria-labelledby="custom-content-below-dato-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.intitucion_universidad') !!}<span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre_institucion_ingles'] : ''; ?>" id="nombre_institucion_ingles" style="border: 1px solid #b9b9b9;" placeholder="Universidad">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.titulo') !!} <span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_ingles'] : ''; ?>" id="titulo_ingles" style="border: 1px solid #b9b9b9;" placeholder="Título">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.lugar') !!} <span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['lugar_ingles'] : ''; ?>" id="lugar_ingles" style="border: 1px solid #b9b9b9;" placeholder="Lugar de Estudio">
                    </div>

                       <div class="col-lg-3">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.ano_inicio') !!}<span style="color: red;">*</span></label>
                        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['ano_inicio'] : ''; ?>" id="ano_inicio" style="border: 1px solid #b9b9b9;" >
                    </div>
                    <div class="col-lg-3">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.ano_fin') !!}<span style="color: red;">*</span></label>
                        <input type="date" class="form-control input-sm" value="<?php echo $data ? $data['ano_fin'] : ''; ?>" id="ano_fin" style="border: 1px solid #b9b9b9;" >
                    </div>
                </div>
              </div>
                    <div class="col-lg-12 text-right">
                        <hr>
                        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
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
                nombre_institucion_ingles: $('#nombre_institucion_ingles').val(),
                titulo: $('#titulo').val(),
                titulo_ingles: $('#titulo_ingles').val(),
                lugar: $('#lugar').val(),
                lugar_ingles: $('#lugar_ingles').val(),
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