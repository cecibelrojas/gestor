<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12 text-center">
        <img onclick="$('#foto').trigger('click');" src="<?php echo ($data && !empty($data['foto'])) ? url('/') . $data['foto'] : asset('archivos/waika/img.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 500px;height: 333px;" class="imgpreview">
        <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 1000px * 666px | Peso Max. 1MB <br> Formato: JPG o PNG</p>
        <input type="file" id="foto" name="foto" style="display: none;">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Título de la Fotografía <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['titulo'] : ''; ?>" maxlength="100" id="titulo" style="border: 1px solid #b9b9b9;" >
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Descripción <span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['descripcion'] : ''; ?>" maxlength="200" id="descripcion" style="border: 1px solid #b9b9b9;" >
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Autor de la Fotografía<span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['autor'] : ''; ?>" maxlength="100" id="autor" style="border: 1px solid #b9b9b9;" >
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Categoría<span style="color: red;">*</span></label>
<select class="form-control" name="categoria" id="categoria" required>
                                <?php if (count($categorias)) : ?>
                                    <?php foreach ($categorias as $key) : ?>
                                        <option <?php echo ($data && $data['categoria'] == $key['id']) ? "selected" : ""; ?> value="<?php echo $key['id']; ?>"><?php echo $key['nombre']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
    </div>

    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>


</div>
<script>
    $("#foto").change(function() {

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
        formData.append('categoria', $('#categoria').val());
        formData.append('autor', $('#autor').val());
        formData.append('descripcion', $('#descripcion').val());

        formData.append('foto', $('#foto').val());

        var files = $('#foto').get(0).files;
        formData.append('foto', files[0]);

        $.ajax({
            url: '<?php echo url('/guardarfotogaleria') ?>',
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