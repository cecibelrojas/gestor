<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id2" value="<?php echo $id; ?>">
<input type="hidden" id="accion" value="<?php echo $accion; ?>">
<!-- -->
<div class="row">
    <div class="col-lg-12">
        <table class="table" id="pubTable">
            <thead>
                <tr>
                    <th style="width: 10%;font-size: 11px;">Código</th>
                    <th style="font-size: 11px;">Nombre</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-lg-12 text-right">
        <hr>
        <button id="btnSave2" class="btn btn-sm btn-success">Guardar Cambios</button>
    </div>
</div>
<script>
    var dataPub = <?php echo json_encode($data); ?>;
    var pubTable = $('#pubTable').DataTable({
        data: dataPub,
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'nombre'
            }

        ]
    });
    $('#btnSave2').click(function() {

        if ($('#codigo').val() == '') {
            swal({
                type: "info",
                title: "¡El campo código es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        if ($('#nombre').val() == '') {
            swal({
                type: "info",
                title: "¡El campo nombre es requerido!",
                showConfirmButton: true
            });
            return false;
        }

        $.ajax({
            url: '<?php echo url('/guardar-widget-detalle') ?>',
            type: 'POST',
            data: {
                id: $('#id2').val(),
                item: $('#item').val(),
                nombre: $('#nombre2').val(),
                accion: $('#accion').val()
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
                    //location.reload();
                    filtrar2();
                    $('#modal-nuevo2').modal('hide');
                });
            },
            error: function() {
                $('#btnSave').html("Guardar Cambios").attr('disabled', false);
            }
        });
    });
</script>