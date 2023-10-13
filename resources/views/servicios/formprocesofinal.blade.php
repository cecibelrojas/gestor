<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="subproceso_final_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="subserviciofinal_id" value="<?php echo $subserviciofinal_id; ?>">
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
                    <div class="col-lg-12">
                        <br>
                    <textarea id="contenido" class="summernote" rows="9" name="contenido">{{ @$data->contenido }}</textarea>
                    </div>   
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <br>
                    <textarea id="contenido_ingles" class="summernote"  name="contenido_ingles">{{ @$data->contenido_ingles }}</textarea>
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
    $('#btnSave').click(function() {

        if ($('#contenido').val() == '') {
            swal({
                type: "info",
                title: "¡El campo es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        var formData = new FormData();

        formData.append('id', $('#subproceso_final_id').val());
        formData.append('subserviciofinal_id', $('#subserviciofinal_id').val());
        formData.append('contenido', $('#contenido').val());
        formData.append('contenido_ingles', $('#contenido_ingles').val());

        $.ajax({
            url: '<?php echo url('/guardar-contenido-final') ?>',
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


</script>