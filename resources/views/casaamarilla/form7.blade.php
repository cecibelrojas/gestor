<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#imagen_items').trigger('click');" src="<?php echo ($data && !empty($data['imagen_items'])) ? url('/') . $data['imagen_items'] : asset('archivos/casa_amarilla/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 64px; height: 64px;" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 64px * 64px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="imagen_items" name="imagen_items" style="display: none;">
    </div>
    </div>
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
                        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ @$data->titulo}}" style="border: 1px solid #b9b9b9;" maxlength="100">
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
                        <input type="text" name="titulo_ingles" id="titulo_ingles" class="form-control" value="{{ @$data->titulo_ingles}}" style="border: 1px solid #b9b9b9;" maxlength="100">
                    </div>
                </div>
              </div>

            </div>


    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
    </div>

<script>
        $("#imagen_items").change(function() {

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


        var formData = new FormData();
        
        formData.append('id', $('#id').val());
        formData.append('titulo', $('#titulo').val());
        formData.append('titulo_ingles', $('#titulo_ingles').val());
        formData.append('estado', $('#estado').val());

        formData.append('imagen_items', $('#imagen_items').val());

        var files = $('#imagen_items').get(0).files;
        formData.append('imagen_items', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-items') ?>',
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