<div class="modal-header">
    <h5 class="modal-title" id="titleModal">Registrar Juegos</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">

        <div class="col-lg-4">
            <label for="entidad" style="font-size: 12px;font-weight: bold;">Entidad</label>
            <select id="entidad" class="form-control input-sm">
                <option value="">Seleccionar</option>
                <?php if (count($entidades) > 0) : ?>
                    <?php foreach ($entidades as $key) : ?>
                        <option <?php echo ($key['item'] == @$data['entidad']) ? "selected" : ""; ?> value="<?php echo $key['item']; ?>"><?php echo $key['nombre']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="col-lg-8">
            <table class="table table-bordered" style="border-radius: 8px;margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th style="background-color: #2196f3;color: #fff;font-size: 14px;text-align: center;padding: 5px;" colspan="2">Equipos Programados
                            <?php if (!$data) : ?>
                                <a onclick="addTeam();" style="right: 12px;background-color: #fff;color: #2196f3;font-size: 10px;padding: 4px 10px;position: absolute;top: 5px;border-radius: 4px;cursor: pointer;">Agregar Equipos</a>
                            <?php endif; ?>
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 50%;background-color: #b9b9b9;color: #000;font-size: 14px;text-align: center;padding: 5px;">Local</th>
                        <th style="width: 50%;background-color: #b9b9b9;color: #000;font-size: 14px;text-align: center;padding: 5px;">Visitante</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$data) : ?>
                        <tr>
                            <td style="text-align: center;">
                                <img src="{{ asset('images/icons/desconocido.png') }}" id="localimg" style="width: 80px;height: 80px;object-fit: contain;"><br>
                                <b id="localname"></b>
                            </td>
                            <td style="text-align: center;">
                                <img src="{{ asset('images/icons/desconocido.png') }}" id="visitorimg" style="width: 80px;height: 80px;object-fit: contain;"><br>
                                <b id="visitorname"></b>
                            </td>
                        </tr>
                    <?php else : ?>
                        <tr>
                        <tr>
                            <td style="text-align: center;">
                                <img src="<?php echo url('/') . $data['local']['logo']; ?>" id="localimg" style="width: 80px;height: 80px;object-fit: contain;"><br>
                                <b id="localname"><?php echo $data['local']['nombreteam']; ?></b>
                            </td>
                            <td style="text-align: center;">
                                <img src="<?php echo url('/') . $data['visitor']['logo']; ?>" id="visitorimg" style="width: 80px;height: 80px;object-fit: contain;"><br>
                                <b id="visitorname"><?php echo $data['visitor']['nombreteam']; ?></b>
                            </td>
                        </tr>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
        <div class="col-lg-12">
            <label for="title" style="font-size: 12px;font-weight: bold;">Titulo</label>
            <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo isset($data) ? $data['titulo'] : ''; ?>">
            <input type="hidden" name="id">
        </div>
        <div class="col-lg-4">
            <label for="fecha" style="font-size: 12px;font-weight: bold;">Fecha</label>
            <input type="datetime-local" value="<?php echo isset($data) ? $data['fecha'] : $fecha; ?>" name="fecha" class="form-control" id="fecha">
        </div>
        <div class="col-lg-4">
            <label for="lugar" style="font-size: 12px;font-weight: bold;">Lugar</label>
            <input type="text" name="lugar" class="form-control" id="lugar" value="<?php echo isset($data) ? $data['lugar'] : ''; ?>">
        </div>
        <div class="col-lg-4">
            <label for="sede" style="font-size: 12px;font-weight: bold;">Sede</label>
            <input type="text" name="sede" class="form-control" id="sede" value="<?php echo isset($data) ? $data['sede'] : ''; ?>">
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="descripcion" style="font-size: 12px;font-weight: bold;">Descripción</label>
                <textarea class="form-control" name="description" id="descripcion" rows="4"><?php echo isset($data) ? $data['descripcion'] : ''; ?></textarea>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?php if ($data) : ?>
        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $data['id']; ?>)" id="eliminar">Eliminar</button>
    <?php endif; ?>
    <?php if (!$data) : ?>
        <button type="button" id="btnSaveEvent" class="btn btn-success">Guardar</button>
    <?php endif; ?>
</div>
<div class="modal fade" id="modalTeams">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Seleccion de equipos</h5>
            </div>
            <div class="modal-body">
                <div id="teams-content"></div>
            </div>
        </div>
    </div>
</div>

<script>
    var equipos = [];
    var teams = [];

    function buildteams() {
        if (equipos.length > 0) {

            var titulo = "";

            $.each(equipos, function(item, key) {
                if (key.casa == 'S') {
                    $('#localimg').attr('src', key.image);
                    $('#localname').html(key.name);
                    titulo += key.name + " Vs ";
                    $('#lugar').val(key.ciudad);
                    $('#sede').val(key.sede);
                }

                if (key.casa == 'N') {
                    $('#visitorimg').attr('src', key.image);
                    $('#visitorname').html(key.name);
                    titulo += key.name;
                }
            });

            $('#titulo').val(titulo);
        } else {

            $('#localimg').attr('src', '<?php echo asset('images/icons/desconocido.png'); ?>');
            $('#visitorimg').attr('src', '<?php echo asset('images/icons/desconocido.png'); ?>');
            $('#localname').html('');
            $('#visitorname').html('');
        }
    }

    function addTeam() {
        if ($('#entidad').val() == '') {
            swal({
                type: "info",
                title: "¡El campo entidad es requerido!",
                showConfirmButton: true
            });
            return false;
        }
        equipos = [];
        buildteams();
        $('#modalTeams').modal('show');
        $.post('<?php echo url('teams'); ?>', {
            entidad: $('#entidad').val()
        }, function(view) {
            $('#teams-content').html(view);
        });


    }

    $('#btnSaveEvent').click(function() {

        var formData = new FormData();
        formData.append('id', $('#id').val());
        formData.append('titulo', $('#titulo').val());
        formData.append('fecha', $('#fecha').val());
        formData.append('descripcion', $('#descripcion').val());
        formData.append('entidad', $('#entidad').val());
        formData.append('sede', $('#sede').val());
        formData.append('lugar', $('#lugar').val());

        formData.append('teams', JSON.stringify(equipos));

        $.ajax({
            url: '<?php echo url('/guardar-programacion'); ?>',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: function() {

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

            }
        });
    });

    function eliminar(id = null) {

        swal({
            title: '¿Seguro desea eliminar el registro seleccionado?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: '¡Eliminar!',
            confirmButtonColor: '#dd3333',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo url('/eliminar-programacion') ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    beforeSend: function() {

                    },
                    success: function(data) {

                        if (typeof data.errorMessage != 'undefined') {
                            swal({
                                icon: 'error',
                                text: data.errorMessage,
                                showConfirmButton: true
                            });
                            return false;
                        }

                        swal({
                            icon: 'success',
                            title: '¡Eliminado!',
                            text: 'El registro ha sido eliminado.',
                            showConfirmButton: true,
                            timer: 1500
                        }).then(function(result) {
                            location.reload();
                        });
                    },
                    error: function() {

                    }
                });
            }
        })

    }
</script>