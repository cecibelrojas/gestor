<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">

        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">{{ __("Spanish") }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false"> {{ __("English") }}</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <input type="text" name="items" id="items" class="form-control" value="{{ @$data->items }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <input type="text" name="items_ingles" id="items_ingles" class="form-control" value="{{ @$data->items_ingles }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                </div>
              </div>

            </div>
              <div class="col-lg-12 text-right">
                        <hr>
                        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
               </div>


<script>

    $('#btnSave').click(function() {

        if ($('#items').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Titulo es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardar-normas') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                items: $('#items').val(),
                items_ingles: $('#items_ingles').val(),

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