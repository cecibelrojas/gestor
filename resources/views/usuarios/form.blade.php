<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">
<!-- -->
<div class="col-lg-12 text-center">
    <img onclick="$('#foto').trigger('click');" src="<?php echo ($data && !empty($data['foto'])) ? url('/') . $data['foto'] : asset('images/icons/default-image.png'); ?>" style="object-fit: cover;box-shadow: 1px 1px 8px 0px #7e7e7e;cursor: pointer;width: 90px;height: 90px;" class="rounded-circle imgpreview">
    <p class="help-block small" style="font-size: 11px;margin-top: 10px;line-height: 1.1;">Dimensiones: 200px * 200px | Peso Max. 2MB <br> Formato: JPG o PNG</p>
    <input type="file" id="foto" name="foto" style="display: none;">
</div>
<div class="row">
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Nombre y Apellido</label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['name'] : ''; ?>" id="name" style="border: 1px solid #b9b9b9;" placeholder="Nombre y Apellido del Usuario">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Correo Electrónico <span style="color: red;">*</span></label>
        <input type="email" class="form-control input-sm" value="<?php echo $data ? $data['email'] : ''; ?>" id="email" style="border: 1px solid #b9b9b9;" placeholder="Email">
    </div>
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Télefono<span style="color: red;">*</span></label>
        <input type="text" class="form-control input-sm" value="<?php echo $data ? $data['telefono'] : ''; ?>" id="telefono" style="border: 1px solid #b9b9b9;" placeholder="Télefono">
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Perfil <span style="color: red;">*</span></label>
        <select class="form-control form-select" aria-label="Perfil" id="rol">
            <option value="">Seleccione</option>
            <option value="A" <?php if ($data && 'A' == $data['rol']) { ?> selected <?php } ?>>Administrador</option>
            <option value="B" <?php if ($data && 'B' == $data['rol']) { ?> selected <?php } ?>>Voces</option>
            <option value="C" <?php if ($data && 'C' == $data['rol']) { ?> selected <?php } ?>>Redactor</option>
            <option value="D" <?php if ($data && 'D' == $data['rol']) { ?> selected <?php } ?>>Corrector</option>
            <option value="V" <?php if ($data && 'V' == $data['rol']) { ?> selected <?php } ?>>Corrector(a) Voces</option>            
            <option value="E" <?php if ($data && 'E' == $data['rol']) { ?> selected <?php } ?>>Jefe Redacción / Información</option>
            <option value="F" <?php if ($data && 'F' == $data['rol']) { ?> selected <?php } ?>>Escuela YA</option>
            <option value="G" <?php if ($data && 'G' == $data['rol']) { ?> selected <?php } ?>>Audiovisual</option>
            <option value="H" <?php if ($data && 'H' == $data['rol']) { ?> selected <?php } ?>>Deportes</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label style="font-size: 12px;font-weight: bold;">Estado</label>
        <select class="form-control form-select" aria-label="estado" id="estado">
            <option value="">Seleccione</option>
            <option value="A" <?php if ($data && 'A' == $data['estado']) { ?> selected <?php } ?>>Activo</option>
            <option value="I" <?php if ($data && 'I' == $data['estado']) { ?> selected <?php } ?>>Inactivo</option>
        </select>
    </div>
    @if (empty($data && $data["id"]))
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Contraseña <span style="color: red;">*</span></label>
        <input type="password" class="form-control input-sm" id="password" style="border: 1px solid #b9b9b9;" autocomplete="new-password" placeholder="Contraseña mínimo de 8 caracteres">
    </div>
     @endif
         @if (empty($data && $data["id"]))
    <div class="col-lg-12">
        <label style="font-size: 12px;font-weight: bold;">Repetir Contraseña <span style="color: red;">*</span></label>
        <input type="password" class="form-control input-sm" id="password-confirm" value="<?php echo $data ? $data['password_confirmation'] : ''; ?>" style="border: 1px solid #b9b9b9;" autocomplete="new-password" placeholder="Confirmar contraseña">
    </div>
        @endif
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    $("input[type='file']").change(function() {

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

        if ($('#name').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Nombre y Apellido es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#email').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Correo Electrónico es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#rol').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Perfil es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#password').val() == '') {
            swal({
                type: "info",
                title: "¡El campo password es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        if ($('#password-confirm').val() == '') {
            swal({
                type: "info",
                title: "¡El campo Confirmar password es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        var formData = new FormData();

        formData.append('id', $('#id').val());
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('telefono', $('#telefono').val());        
        formData.append('rol', $('#rol').val());
        formData.append('estado', $('#estado').val());
        formData.append('password', $('#password').val());

        var files = $('#foto').get(0).files;
        formData.append('foto', files[0]);

        $.ajax({
            url: '<?php echo url('/guardar-usuario') ?>',
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