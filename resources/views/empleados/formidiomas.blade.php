<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="idioma_id" value="<?php echo $data ? $data['id'] : ''; ?>">
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
                <div class="col-lg-12">
                    <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.idioma') !!}<span style="color: red;">*</span></label>
                    <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['idioma'] : ''; ?>" id="idioma" style="border: 1px solid #b9b9b9;" placeholder="Idioma">
                </div>
            </div>

              </div>
              <div class="tab-pane fade" id="custom-content-below-dato" role="tabpanel" aria-labelledby="custom-content-below-dato-tab">
            <div class="row" style="margin-top:20px">
                <div class="col-lg-12">
                    <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.idioma') !!}<span style="color: red;">*</span></label>
                    <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['idioma_ingles'] : ''; ?>" id="idioma_ingles" style="border: 1px solid #b9b9b9;" placeholder="Idioma">
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
                idioma: $('#idioma').val(),
                idioma_ingles: $('#idioma_ingles').val()
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