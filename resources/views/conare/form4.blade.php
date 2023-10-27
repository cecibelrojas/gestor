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
                        <label style="font-size: 12px;font-weight: bold;">Título</label>
                        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ @$data->titulo }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ @$data->direccion }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Jurisdicción</label>
                        <input type="text" name="jurisdiccion" id="jurisdiccion" class="form-control" value="{{ @$data->jurisdiccion }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Horario</label>
                        <input type="text" name="horario" id="horario" class="form-control" value="{{ @$data->horario }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ @$data->telefono }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Estado</label>
                        <select class="form-control form-select" aria-label="estado" id="estado">
                            <option value="">Seleccione</option>
                            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>Activo</option>
                            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>Inactivo</option>
                        </select>
                    </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Título</label>
                        <input type="text" name="titulo_ingles" id="titulo_ingles" class="form-control" value="{{ @$data->titulo_ingles }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Direccion</label>
                        <input type="text" name="direccion_ingles" id="direccion_ingles" class="form-control" value="{{ @$data->direccion_ingles }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Jurisdicción</label>
                        <input type="text" name="jurisdiccion_ingles" id="jurisdiccion_ingles" class="form-control" value="{{ @$data->jurisdiccion_ingles }}" style="border: 1px solid #b9b9b9;"> 
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

        if ($('#titulo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#direccion').val() == '') {
            swal({
                type: "info",
                title: "¡El campo es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#jurisdiccion').val() == '') {
            swal({
                type: "info",
                title: "¡El campo es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#horario').val() == '') {
            swal({
                type: "info",
                title: "¡El campo es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#telefono').val() == '') {
            swal({
                type: "info",
                title: "¡El campo es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardar-ubicaciones') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                titulo: $('#titulo').val(),
                titulo_ingles: $('#titulo_ingles').val(),
                direccion: $('#direccion').val(),
                direccion_ingles: $('#direccion_ingles').val(),
                jurisdiccion: $('#jurisdiccion').val(),
                jurisdiccion_ingles: $('#jurisdiccion_ingles').val(),
                horario: $('#horario').val(),
                telefono: $('#telefono').val(),
                estado: $('#estado').val()

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