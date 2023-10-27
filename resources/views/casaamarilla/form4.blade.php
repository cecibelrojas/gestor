<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#parallax2').trigger('click');" src="<?php echo ($data && !empty($data['parallax2'])) ? url('/') . $data['parallax2'] : asset('archivos/casa_amarilla/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 100%" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 3000px aprox * 3000px aprox | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="parallax2" name="parallax2" style="display: none;">
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
                        <input type="text" name="titulo_pllx2" id="titulo_pllx2" class="form-control" value="{{ @$data->titulo_pllx2}}" style="border: 1px solid #b9b9b9;" maxlength="100">
                    </div>
                    <div class="col-lg-12">
                        <br>
                        <input type="text" name="contenido_pllx2" id="contenido_pllx2" class="form-control" value="{{ @$data->contenido_pllx2}}" style="border: 1px solid #b9b9b9;"  placeholder="Descripción del parallax">
                    </div>

                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <input type="text" name="titulo_pllx2_ingles" id="titulo_pllx2_ingles" class="form-control" value="{{ @$data->titulo_pllx2_ingles}}" style="border: 1px solid #b9b9b9;" maxlength="100">
                    </div>
                    <div class="col-lg-12">
                        <br>
                        <input type="text" name="contenido_pllx2_ingles" id="contenido_pllx2_ingles" class="form-control" value="{{ @$data->contenido_pllx2_ingles}}" style="border: 1px solid #b9b9b9;" placeholder="Descripción del parallax">
                    </div>

                </div>
              </div>

            </div>


    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
    </div>

<script>
        $("#parallax2").change(function() {

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
        formData.append('titulo_pllx2', $('#titulo_pllx2').val());
        formData.append('titulo_pllx2_ingles', $('#titulo_pllx2_ingles').val());
        formData.append('contenido_pllx2', $('#contenido_pllx2').val());
        formData.append('contenido_pllx2_ingles', $('#contenido_pllx2_ingles').val());

        formData.append('parallax2', $('#parallax2').val());

        var files = $('#parallax2').get(0).files;
        formData.append('parallax2', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-parallax2') ?>',
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