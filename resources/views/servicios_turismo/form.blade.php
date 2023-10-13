<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
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
                <div class="col-lg-12 text-center ">
                    <img onclick="$('#icono').trigger('click');" src="<?php echo ($data && !empty($data['icono'])) ? url('/') . $data['icono'] : asset('archivos/iconoidentidad/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 250px;height: 180px;" class="imgpreview">
                    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 640px * 420px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
                    <input type="file" id="icono" name="icono" style="display: none;">
                </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.nombreservicio') !!}<span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre_servicio'] : ''; ?>" id="nombre_servicio" name="nombre_servicio" style="border: 1px solid #b9b9b9;" placeholder="Nombre del Servicio ">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.tipo') !!}</label>

                            <select class="form-control" id="tipo" style="font-size: 12px;font-weight: bold;">
                                <option value="">{!! trans('messages.seleccionar') !!}</option>
                                <?php if (count($listaTipos) > 0) : ?>
                                    <?php foreach ($listaTipos as $key) : ?>
                                        <option <?php echo (isset($data['tipo']) && $data['tipo'] == $key['item']) ? "selected" : ""; ?> value="<?php echo $key['item']; ?>"><?php echo $key['nombre']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>


                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.estado') !!}</label>
                        <select class="form-control form-select" aria-label="estado" id="estado">
                            <option value="">Seleccione</option>
                            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>{!! trans('messages.activo') !!}</option>
                            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>{!! trans('messages.inactivo') !!}</option>
                        </select>
                    </div>   
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                 <div class="row"  style="margin-top:20px">
                <div class="col-lg-12 text-center ">
                    <img onclick="$('#icono').trigger('click');" src="<?php echo ($data && !empty($data['icono'])) ? url('/') . $data['icono'] : asset('archivos/iconoidentidad/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 250px;height: 180px;" class="imgpreview">
                    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 640px * 420px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
                    <input type="file" id="icono" name="icono" style="display: none;">
                </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.nombreservicio') !!} <span style="color: red;">*</span></label>
                        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['nombre_servicio_ingles'] : ''; ?>" id="nombre_servicio_ingles" name="nombre_servicio_ingles" style="border: 1px solid #b9b9b9;" placeholder="Nombre del Servicio ">
                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.tipo') !!}</label>

                            <select class="form-control" id="tipo" style="font-size: 12px;font-weight: bold;">
                                <option value="">{!! trans('messages.seleccionar') !!}</option>
                                <?php if (count($listaTipos) > 0) : ?>
                                    <?php foreach ($listaTipos as $key) : ?>
                                        <option <?php echo (isset($data['tipo']) && $data['tipo'] == $key['item']) ? "selected" : ""; ?> value="<?php echo $key['item']; ?>"><?php echo $key['nombre_ingles']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>


                    </div>
                    <div class="col-lg-6">
                        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.estado') !!}</label>
                        <select class="form-control form-select" aria-label="estado" id="estado">
                            <option value="">Seleccione</option>
                            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>{!! trans('messages.activo') !!}</option>
                            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>{!! trans('messages.inactivo') !!}</option>
                        </select>
                    </div>   
                </div>
              </div>
              <div class="col-lg-12 text-right">
                        <hr>
                        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
                    </div>
            </div>

<script>
        $("#icono").change(function() {

        var imagen = this.files[0];
        var documento = this.files[0];
        var tipo = $(this).attr("name");

        /*=============================================
        VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
        =============================================*/


        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {

            var rutaImagen = event.target.result;

            $(".imgpreview").attr("src", rutaImagen);

        })
    })

    $('#btnSave').click(function() {

        if ($('#nombre_servicio').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Nombre de Servicio Biblioteca es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#cboTipo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Tipo es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#estado').val() == '') {
            swal({
                type: "info",
                title: "¡El campo estado es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        var formData = new FormData();

        formData.append('id', $('#id').val());
        formData.append('nombre_servicio', $('#nombre_servicio').val());
        formData.append('nombre_servicio_ingles', $('#nombre_servicio_ingles').val());
        formData.append('tipo', $('#tipo').val());
        formData.append('estado', $('#estado').val());

        formData.append('icono', $('#icono').val());

        var files = $('#icono').get(0).files;
        formData.append('icono', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-servicioturismo') ?>',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
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