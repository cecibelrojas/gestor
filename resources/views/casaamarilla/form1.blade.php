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
                        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ @$data->titulo }}" style="border: 1px solid #b9b9b9;" maxlength="300" onkeyup="countCharsSumario(this);"> 
                        <p id="charNumSumario" style="text-align: right;">300 {!! trans('messages.caracteres') !!}</p>                    
                    </div>
                    <div class="col-lg-12">
                    <textarea id="contenido1" class="summernote" rows="9" name="contenido1">{{ @$data->contenido1 }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="titulo2" id="titulo2" class="form-control" value="{{ @$data->titulo2 }}" style="border: 1px solid #b9b9b9;" placeholder="Título 2"> 
                    </div>

                    <div class="col-lg-6">
                        <input type="text" name="titulo3" id="titulo3" class="form-control" value="{{ @$data->titulo3 }}" style="border: 1px solid #b9b9b9;" placeholder="Título 3">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    <textarea id="contenido2" class="summernote" rows="9" name="contenido2">{{ @$data->contenido2 }}</textarea>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" name="titulo4" id="titulo4" class="form-control" value="{{ @$data->titulo4 }}" style="border: 1px solid #b9b9b9;" placeholder="Título 4">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    <textarea id="contenido3" class="summernote" rows="9" name="contenido3">{{ @$data->contenido3 }}</textarea>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="item1" id="item1" class="form-control" value="{{ @$data->item1 }}" style="border: 1px solid #b9b9b9;" placeholder="item1">
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="item2" id="item2" class="form-control" value="{{ @$data->item2 }}" style="border: 1px solid #b9b9b9;" placeholder="item2">
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="item3" id="item3" class="form-control" value="{{ @$data->item3 }}" style="border: 1px solid #b9b9b9;" placeholder="item3">
                    </div>

                    <div class="col-lg-4">
                        <br>
                        <input type="text" name="item4" id="item4" class="form-control" value="{{ @$data->item4 }}" style="border: 1px solid #b9b9b9;" placeholder="item4">
                    </div>
                    <div class="col-lg-4">
                        <br>
                        <input type="text" name="item5" id="item5" class="form-control" value="{{ @$data->item5 }}" style="border: 1px solid #b9b9b9;" placeholder="item5">
                    </div>
                    <div class="col-lg-4">
                        <br>
                        <input type="text" name="item6" id="item6" class="form-control" value="{{ @$data->item6 }}" style="border: 1px solid #b9b9b9;" placeholder="item6">
                    </div>

                    <div class="col-lg-12">
                        <hr>
                        <label style="font-size: 12px;font-weight: bold;">Sección Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ @$data->direccion }}" style="border: 1px solid #b9b9b9;" placeholder="Direccion">
                    </div>
                    <div class="col-lg-4">
                        <label style="font-size: 12px;font-weight: bold;">Correos</label>
                        <input type="text" name="correo1" id="correo1" class="form-control" value="{{ @$data->correo1 }}" style="border: 1px solid #b9b9b9;" placeholder="Correo">
                    </div>
                    <div class="col-lg-4">
                        <label style="font-size: 12px;font-weight: bold;">Correos</label>
                        <input type="text" name="correo2" id="correo2" class="form-control" value="{{ @$data->correo2 }}" style="border: 1px solid #b9b9b9;" placeholder="Correo">
                    </div>
                    <div class="col-lg-4">
                        <label style="font-size: 12px;font-weight: bold;">Correos</label>
                        <input type="text" name="correo3" id="correo3" class="form-control" value="{{ @$data->correo3 }}" style="border: 1px solid #b9b9b9;" placeholder="Correo">
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <label style="font-size: 12px;font-weight: bold;">Sección Horario</label>
                        <input type="text" name="horario" id="horario" class="form-control" value="{{ @$data->horario }}" style="border: 1px solid #b9b9b9;" placeholder="Horario">
                    </div>
                    <div class="col-lg-12">
                        <label style="font-size: 12px;font-weight: bold;">Estado de Servicios en Casa Amarilla</label>
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
                        <input type="text" name="titulo_ingles" id="titulo_ingles" class="form-control" value="{{ @$data->titulo_ingles }}" style="border: 1px solid #b9b9b9;" maxlength="300" onkeyup="countCharsSumario(this);"> 
                        <p id="charNumSumario" style="text-align: right;">300 {!! trans('messages.caracteres') !!}</p>                    
                    </div>

                    <div class="col-lg-12">
                        <br>
                    <textarea id="contenido1_ingles" class="summernote"  name="contenido1_ingles">{{ @$data->contenido1_ingles }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="titulo2_ingles" id="titulo2_ingles" class="form-control" value="{{ @$data->titulo2_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="Título 2"> 
                    </div>
                    <div class="col-lg-6">
                        <input type="text" name="titulo3_ingles" id="titulo3_ingles" class="form-control" value="{{ @$data->titulo3_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="Título 3">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    <textarea id="contenido2_ingles" class="summernote" rows="9" name="contenido2_ingles">{{ @$data->contenido2_ingles }}</textarea>
                    </div>
                    <div class="col-lg-12">
                        <input type="text" name="titulo4_ingles" id="titulo4_ingles" class="form-control" value="{{ @$data->titulo4_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="Título 4">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    <textarea id="contenido3_ingles" class="summernote" rows="9" name="contenido3_ingles">{{ @$data->contenido3_ingles }}</textarea>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="item1_ingles" id="item1_ingles" class="form-control" value="{{ @$data->item1_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="item1">
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="item2_ingles" id="item2_ingles" class="form-control" value="{{ @$data->item2_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="item2">
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="item3_ingles" id="item3_ingles" class="form-control" value="{{ @$data->item3_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="item3">
                    </div>

                    <div class="col-lg-4">
                        <br>
                        <input type="text" name="item4_ingles" id="item4_ingles" class="form-control" value="{{ @$data->item4_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="item4">
                    </div>
                    <div class="col-lg-4">
                        <br>
                        <input type="text" name="item5_ingles" id="item5_ingles" class="form-control" value="{{ @$data->item5_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="item5">
                    </div>
                    <div class="col-lg-4">
                        <br>
                        <input type="text" name="item6_ingles" id="item6_ingles" class="form-control" value="{{ @$data->item6_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="item6">
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <label style="font-size: 12px;font-weight: bold;">Sección Dirección</label>
                        <input type="text" name="direccion_ingles" id="direccion_ingles" class="form-control" value="{{ @$data->direccion_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="Direccion">
                    </div>
                    <div class="col-lg-12">
                        <hr>
                        <label style="font-size: 12px;font-weight: bold;">Sección Horario</label>
                        <input type="text" name="horario_ingles" id="horario_ingles" class="form-control" value="{{ @$data->horario_ingles }}" style="border: 1px solid #b9b9b9;" placeholder="Horario">
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



        if ($('#titulo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Titulo es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardar-contenido_principal') ?>',
            type: 'POST',
            data: {
                id: $('#id').val(),
                titulo: $('#titulo').val(),
                titulo_ingles: $('#titulo_ingles').val(),
                titulo2: $('#titulo2').val(),
                titulo2_ingles: $('#titulo2_ingles').val(),
                contenido1: $('#contenido1').val(),
                contenido1_ingles: $('#contenido1_ingles').val(),
                titulo3: $('#titulo3').val(),
                contenido2: $('#contenido2').val(),
                titulo3_ingles: $('#titulo3_ingles').val(),
                contenido2_ingles: $('#contenido2_ingles').val(),
                titulo4: $('#titulo4').val(),
                titulo4_ingles: $('#titulo4_ingles').val(),
                contenido3: $('#contenido3').val(),
                contenido3_ingles: $('#contenido3_ingles').val(),
                item1: $('#item1').val(),
                item2: $('#item2').val(),
                item3: $('#item3').val(),
                item4: $('#item4').val(),
                item5: $('#item5').val(),
                item6: $('#item6').val(),
                item1_ingles: $('#item1_ingles').val(),
                item2_ingles: $('#item2_ingles').val(),
                item3_ingles: $('#item3_ingles').val(),
                item4_ingles: $('#item4_ingles').val(),
                item5_ingles: $('#item5_ingles').val(),
                item6_ingles: $('#item6_ingles').val(),
                estado: $('#estado').val(),
                direccion: $('#direccion').val(),
                direccion_ingles: $('#direccion_ingles').val(),
                correo1: $('#correo1').val(),
                correo2: $('#correo2').val(),
                correo3: $('#correo3').val(),
                horario: $('#horario').val(),
                horario_ingles: $('#horario_ingles').val()

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