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
                    <label style="font-size: 12px;font-weight: bold;">Subtítulo</label>     
                        <input type="text" name="subtitulo" id="subtitulo" class="form-control" value="{{ @$data->subtitulo }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-12">
                    <label style="font-size: 12px;font-weight: bold;">Descripción</label>    
                    <textarea id="descripcion" class="summernote" rows="9" name="descripcion">{{ @$data->descripcion }}</textarea>
                    </div>
                    <div class="col-lg-12">
                     <label style="font-size: 12px;font-weight: bold;">Título Ubicación geoestratégica</label>    
                        <input type="text" name="titulo_des" id="titulo_des" class="form-control" value="{{ @$data->titulo_des }}" style="border: 1px solid #b9b9b9;" placeholder="Título 2"> 
                    </div>

                    <div class="col-lg-12">
                    <label style="font-size: 12px;font-weight: bold;">Ubicación geoestratégica</label>    
                    <textarea id="descripcion_ubicacion" class="summernote" rows="9" name="descripcion_ubicacion">{{ @$data->descripcion_ubicacion }}</textarea>
                    </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                <div class="row" style="margin-top:20px">
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Subtítulo</label> 
                        <input type="text" name="subtitulo_ingles" id="subtitulo_ingles" class="form-control" value="{{ @$data->subtitulo_ingles }}" style="border: 1px solid #b9b9b9;"> 
                    </div>
                    <div class="col-lg-12">
                    <label style="font-size: 12px;font-weight: bold;">Descripción</label>     
                    <textarea id="descripcion_ingles" class="summernote" rows="9" name="descripcion_ingles">{{ @$data->descripcion_ingles }}</textarea>
                    </div>
                    <div class="col-lg-12">
                    <label style="font-size: 12px;font-weight: bold;">Título Ubicación geoestratégica</label>    
                        <input type="text" name="titulo_des_ingles" id="titulo_des_ingles" class="form-control" value="{{ @$data->titulo_des_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="Título 2"> 
                    </div>

                    <div class="col-lg-12">
                    <label style="font-size: 12px;font-weight: bold;">Ubicación geoestratégica</label>    
                    <textarea id="descripcion_ubicacion_ingles" class="summernote" rows="9" name="descripcion_ubicacion_ingles">{{ @$data->descripcion_ubicacion_ingles }}</textarea>
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
            height: 100,
        onImageUpload: function(files){

            for(var i = 0; i < files.length; i++){

                upload_sm(files[i]);

            }

        }

        });

    $('#btnSave').click(function() {



        if ($('#subtitulo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardar-contenido_conare') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                subtitulo: $('#subtitulo').val(),
                subtitulo_ingles: $('#subtitulo_ingles').val(),
                descripcion: $('#descripcion').val(),
                descripcion_ingles: $('#descripcion_ingles').val(),
                titulo_des: $('#titulo_des').val(),
                titulo_des_ingles: $('#titulo_des_ingles').val(),
                descripcion_ubicacion: $('#descripcion_ubicacion').val(),
                descripcion_ubicacion_ingles: $('#descripcion_ubicacion_ingles').val()

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