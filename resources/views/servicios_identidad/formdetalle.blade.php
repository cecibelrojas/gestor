<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="detalle_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="identidad_id" value="<?php echo $identidad_id; ?>">

<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
    <img onclick="$('#imagen_principal').trigger('click');" src="<?php echo ($data && !empty($data['imagen_principal'])) ? url('/') . $data['imagen_principal'] : asset('archivos/identidad_nacional/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 100%" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 1200px * 400px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
    <input type="file" id="imagen_principal" name="imagen_principal" style="display: none;">
    </div>
</div>
<hr>
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
                        <input type="text" name="sumario" id="sumario" class="form-control" value="{{ @$data->sumario }}" style="border: 1px solid #b9b9b9;" maxlength="300" onkeyup="countCharsSumario(this);"> 
                        <p id="charNumSumario" style="text-align: right;">300 {!! trans('messages.caracteres') !!}</p>                    
                    </div>
                    <div class="col-lg-12">
                        <br>
                    <textarea id="descripcion" class="summernote" rows="9" name="descripcion">{{ @$data->descripcion }}</textarea>
                    </div>   
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <input type="text" name="sumario_ingles" id="sumario_ingles" class="form-control" value="{{ @$data->sumario_ingles }}" style="border: 1px solid #b9b9b9;" maxlength="300" onkeyup="countCharsSumario(this);"> 
                        <p id="charNumSumario" style="text-align: right;">300 {!! trans('messages.caracteres') !!}</p>                    
                    </div>

                    <div class="col-lg-12">
                        <br>
                    <textarea id="descripcion_ingles" class="summernote"  name="descripcion_ingles">{{ @$data->descripcion_ingles }}</textarea>
                    </div>   
                </div>
              </div>

            </div>
              <div class="col-lg-12 text-right">
                        <hr>
                        <button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
               </div>


<script>
        $(".summernote").summernote({
            height: 300,
        onImageUpload: function(files){

            for(var i = 0; i < files.length; i++){

                upload_sm(files[i]);

            }

        }

        });

        $("#imagen_principal").change(function() {

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
        
        formData.append('id', $('#detalle_id').val());
        formData.append('identidad_id', $('#identidad_id').val());
        formData.append('descripcion', $('#descripcion').val());
        formData.append('descripcion_ingles', $('#descripcion_ingles').val());
        formData.append('sumario', $('#sumario').val());
        formData.append('sumario_ingles', $('#sumario_ingles').val());

        formData.append('imagen_principal', $('#imagen_principal').val());

        var files = $('#imagen_principal').get(0).files;
        formData.append('imagen_principal', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-imgprincipal') ?>',
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

        function upload_smc(file){

    var datos = new FormData(); 
    datos.append('file', file, file.name);
    datos.append("carpeta", "blog");

    $.ajax({
        url:"/uploadblob",
        method: "POST",
        data: datos,
        contentType: false,
        cache: false,
        processData: false,
        success: function (respuesta) {

            $('.summernote').summernote("insertImage", respuesta, function ($image) {
              $image.attr('class', 'img-fluid');
            });

        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(textStatus + " " + errorThrown);
      }

    })

}
    function countCharsSumario(obj) {
        var maxLength = 300;
        var strLength = $(obj).val().length;
        var charRemain = (maxLength - strLength);

        if (charRemain < 0) {
            document.getElementById("charNumSumario").innerHTML = '<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres</span>';
        } else {
            document.getElementById("charNumSumario").innerHTML = charRemain + ' caracteres restantes';
        }
    }
</script>