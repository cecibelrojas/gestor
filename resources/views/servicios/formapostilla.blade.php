<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="detalleservicio_id" value="<?php echo $data ? $data['id'] : ''; ?>">
<input type="hidden" id="subservicio_id" value="<?php echo $subservicio_id; ?>">
<div class="row">
    <div class="col-lg-4 text-center">
    <img onclick="$('#parallax').trigger('click');" src="<?php echo ($data && !empty($data['parallax'])) ? url('/') . $data['parallax'] : asset('archivos/apostilla_subservicios/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 100%" class="imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 1184px * 723px | Peso Max. 1MB  <br> Formato: JPG o PNG</p>
    <input type="file" id="parallax" name="parallax" style="display: none;">
    </div>
    <div class="col-lg-4 text-center">
    <img onclick="$('#infografia').trigger('click');" src="<?php echo ($data && !empty($data['infografia'])) ? url('/') . $data['infografia'] : asset('archivos/apostilla_subservicios/img1.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 100%;" class="imgpreview1">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 1280px * 800px | Peso Max. 1MB  <br> Formato: JPG o PNG</p>
    <input type="file" id="infografia" name="infografia" style="display: none;">
    </div>
    <div class="col-lg-4 text-center">
    <img onclick="$('#fotoslae').trigger('click');" src="<?php echo ($data && !empty($data['fotoslae'])) ? url('/') . $data['fotoslae'] : asset('archivos/apostilla_subservicios/img1.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer; width: 100%;" class="imgpreview2">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 1280px * 800px | Peso Max. 1MB  <br> Formato: JPG o PNG</p>
    <input type="file" id="fotoslae" name="fotoslae" style="display: none;">
    </div>

</div>
<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-videoes-tab" data-toggle="pill" href="#custom-content-below-videoes" role="tab" aria-controls="custom-content-below-videoes" aria-selected="true">{{ __("Spanish") }}</a>
              </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-content-below-videoin-tab" data-toggle="pill" href="#custom-content-below-videoin" role="tab" aria-controls="custom-content-below-videoin" aria-selected="false"> {{ __("English") }}</a>
    </li>
</ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="custom-content-below-videoes" role="tabpanel" aria-labelledby="custom-content-below-videoes-tab">
				 <div class="row">   
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.titulo') !!}</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo1'] : ''; ?>" maxlength="150" id="titulo1" style="border: 1px solid #b9b9b9;" required>
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
				        <textarea class="form-control summernote" id="descripcion1" rows="3" required><?php echo $data ? $data['descripcion1'] : ''; ?></textarea>
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.titulo') !!}</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo2'] : ''; ?>" maxlength="150" id="titulo2" style="border: 1px solid #b9b9b9;" required>
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
				        <textarea class="form-control summernote" id="descripcion2" rows="3" required><?php echo $data ? $data['descripcion2'] : ''; ?></textarea>
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Título SLAE</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_infografia'] : ''; ?>" maxlength="150" id="titulo_infografia" style="border: 1px solid #b9b9b9;" required>
				    </div>
				    <div class="col-lg-8">
				        <label style="font-size: 12px;font-weight: bold;">Título Sección 2</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_parallax'] : ''; ?>" maxlength="150" id="titulo_parallax" style="border: 1px solid #b9b9b9;" required>
				    </div>
				    <div class="col-lg-4">
				        <label style="font-size: 12px;font-weight: bold;">Link Sistema</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['link'] : ''; ?>" id="link" style="border: 1px solid #b9b9b9;" required>
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
				        <textarea class="form-control summernote" id="des_parallax" rows="3" required><?php echo $data ? $data['des_parallax'] : ''; ?></textarea>
				    </div>

				</div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-videoin" role="tabpanel" aria-labelledby="custom-content-below-videoin-tab">
				 <div class="row">   
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Title</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo1_ingles'] : ''; ?>" maxlength="150" id="titulo1_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
				        <textarea class="form-control summernote" id="descripcion1_ingles" rows="3"><?php echo $data ? $data['descripcion1_ingles'] : ''; ?></textarea>
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Title</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo2_ingles'] : ''; ?>" maxlength="150" id="titulo2_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
				        <textarea class="form-control summernote" id="descripcion2_ingles" rows="3"><?php echo $data ? $data['descripcion2_ingles'] : ''; ?></textarea>
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">Title SLAE</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_infografia_ingles'] : ''; ?>" maxlength="150" id="titulo_infografia_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
				    <div class="col-lg-8">
				        <label style="font-size: 12px;font-weight: bold;">Section 2 Title</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo_parallax_ingles'] : ''; ?>" maxlength="150" id="titulo_parallax_ingles" style="border: 1px solid #b9b9b9;">
				    </div>
				    <div class="col-lg-4">
				        <label style="font-size: 12px;font-weight: bold;">System Link</label>
				        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['link'] : ''; ?>" id="link" style="border: 1px solid #b9b9b9;">
				    </div>
				    <div class="col-lg-12">
				        <label style="font-size: 12px;font-weight: bold;">{!! trans('messages.descripcion') !!}<span style="color: red;">*</span></label>
				        <textarea class="form-control summernote" id="des_parallax_ingles" rows="3"><?php echo $data ? $data['des_parallax_ingles'] : ''; ?></textarea>
				    </div>
				</div>
              </div>
             </div>
             <div class="row">
                 <div class="col-lg-12 text-right">
        			<hr>
        			<button id="btnSave" class="btn btn-sm btn-success">{!! trans('messages.guardar') !!}</button>
    			</div>             	
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
        $("#parallax").change(function() {

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
        $("#infografia").change(function() {

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

            $(".imgpreview1").attr("src", rutaImagen);

        })
    })
        $("#fotoslae").change(function() {

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

            $(".imgpreview2").attr("src", rutaImagen);

        })
    })
    $('#btnSave').click(function() {
        
        var formData = new FormData();
        
        formData.append('id', $('#detalleservicio_id').val());
        formData.append('subservicio_id', $('#subservicio_id').val());
        formData.append('titulo1', $('#titulo1').val());
        formData.append('titulo2', $('#titulo2').val());
        formData.append('titulo1_ingles', $('#titulo1_ingles').val());
        formData.append('titulo2_ingles', $('#titulo2_ingles').val());
        formData.append('descripcion1', $('#descripcion1').val());
        formData.append('descripcion2', $('#descripcion2').val());
        formData.append('descripcion1_ingles', $('#descripcion1_ingles').val());
        formData.append('descripcion2_ingles', $('#descripcion2_ingles').val());
        formData.append('titulo_infografia', $('#titulo_infografia').val());
        formData.append('titulo_infografia_ingles', $('#titulo_infografia_ingles').val());
        formData.append('link', $('#link').val());
        formData.append('titulo_parallax', $('#titulo_parallax').val());
        formData.append('titulo_parallax_ingles', $('#titulo_parallax_ingles').val());
        formData.append('des_parallax', $('#des_parallax').val());
        formData.append('des_parallax_ingles', $('#des_parallax_ingles').val());
        formData.append('parallax', $('#parallax').val());
        formData.append('infografia', $('#infografia').val());
        formData.append('fotoslae', $('#fotoslae').val());

        var files = $('#parallax').get(0).files;
        formData.append('parallax', files[0]);

        var files1 = $('#infografia').get(0).files;
        formData.append('infografia', files1[0]);

        var files2 = $('#fotoslae').get(0).files;
        formData.append('fotoslae', files2[0]);

        $.ajax({
            url: '<?php echo url('/guardar-apostillas_subservicio') ?>',
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