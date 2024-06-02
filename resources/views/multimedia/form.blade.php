<!-- ID para acciones de edicion o eliminacion de registro -->
<input type="hidden" id="id" value="<?php echo $data ? $data['id'] : ''; ?>">

<style>
    .multiitem:hover {
        background-color: <?php echo env('COLOR_BG_TERTIARY') ?> !important;
        color: <?php echo env('COLOR_TEXT_TERTIARY') ?> !important;
    }

    .multiitem.active {
        background-color: <?php echo env('COLOR_BG_TERTIARY') ?> !important;
        color: <?php echo env('COLOR_TEXT_TERTIARY') ?> !important;
    }

    #imagenes-content::-webkit-scrollbar {
        display: none;
    }

    #videos-content::-webkit-scrollbar {
        display: none;
    }

    #documentos-content::-webkit-scrollbar {
        display: none;
    }
</style>
<!-- -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="margin: 0px">{!! trans('messages.material_multimedia') !!}</h4><br>
            <p class="card-description" style="font-size: 12px;">{!! trans('messages.des_multimedia') !!}</p>
            <div id="multimedia-content">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php if ($data['tipo']=='I') : ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="imagen-tab" data-toggle="tab" href="#imagen" role="tab" aria-controls="imagen" aria-selected="true">{!! trans('messages.imagenes') !!}</a>
                    </li>
                    <?php endif; ?>
                    <?php if ($data['tipo']=='V') : ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">{!! trans('messages.videos') !!}</a>
                    </li>
                    <?php endif; ?>
                    <?php if ($data['tipo']=='F') : ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="documento-tab" data-toggle="tab" href="#documento" role="tab" aria-controls="documento" aria-selected="false">{!! trans('messages.documentos') !!}</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content" id="myTabContent" style="padding: 0px">
                    <!-- Tab de Imagenes-->
                    <?php if ($data['tipo']=='I') : ?>
                    <div class="tab-pane fade show active" id="imagen" role="tabpanel" aria-labelledby="imagen-tab">
                        <div class="row">

                            <div class="col-lg-12" style="padding-right: 23px;">
                                <input type="hidden" id='Iid'>
                                <div class="row">

                                                <div class="col-lg-4" id="imagenes-content" style="border-right: 1px solid #b9b9b9; max-height: 650px;overflow: auto;">
                                                    <div class="row" style="margin-left: 0px;">
                                                        <table class="table">
                                                          <thead>
                                                            <tr>
                                                              <th scope="col">Atributos</th>
                                                              <th scope="col">Detalle</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <tr>
                                                              <td width="10%">URL</td>
                                                              <td><div style="width: 150px"><?php echo env('APP_ADMIN') . "/archivos/imagenes_medios/" . $data['archivo']; ?></div></td>
                                                            </tr>
                                                            <tr>
                                                              <td width="10%">Dimensiones</td>
                                                              <td>
                                                                <?php 

                                                                    // Calling getimagesize() function 
                                                                    list($width, $height) = getimagesize(env('APP_ADMIN') . "/archivos/imagenes_medios/" . $data['archivo']); 
                                                                       
                                                                    // Displaying dimensions of the image 
                                                                    echo "Ancho: " . $width .' pixeles '. "<br>"; 
                                                                      
                                                                    echo "Alto: " . $height .' pixeles '. "<br>"; 
                                                                                                                                        
                                                                ?>
                                                              </td>                                                         
                                                            </tr>

                                                          </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                    <div class="col-lg-8" style="padding-top: 10px;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>{!! trans('messages.titulo') !!}</label>
                                                <input type="text" class="form-control" value=" <?php echo $data ? $data['titulo'] : ''; ?>" id="Ititulo">
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <div onclick="$('#imgupload').trigger('click');" id="mimgcontent" style="margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                    <img style="width: 20%;margin-bottom: 10px;" src="<?php echo asset('/images/icons/add-image.png'); ?>"><br>
                                                    <span style="font-size: 12px;">Subir Imagen <br> <span style="font-size: 10px;">{!! trans('messages.formatos_recomendados') !!} </span></span>
                                                </div>
                                                <img onclick="$('#imgupload').trigger('click');" id="mimgpreview" style="display: none;width: 100%;margin-bottom: 10px;margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;cursor: pointer;" src="<?php echo asset('/images/icons/add-image.png'); ?>">
                                            </div>
                                            <div class="col-lg-12" style="margin-top: 10px;">
                                                <label>{!! trans('messages.descripcion') !!} </label>
                                                <textarea style="resize: none;height: 100px" class="form-control" id="Idescripcion"></textarea>
                                            </div>
                                            <div class="col-lg-12" style="margin-bottom: 10px;">
                                                <hr>
                                                <input type="file" id="imgupload" style="display: none;">
                                                <button type="button" id="btnSaveI" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #4caf50;font-size: 13px;padding: 10px;border: 1px solid #4caf50;border-radius: 4px;font-weight: bold;background-color: transparent;"><i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i>{!! trans('messages.guardar') !!}</button>
                                                <button type="button" id="btnDelI" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #ff766d;font-size: 13px;padding: 10px;border: 1px solid #ff766d;border-radius: 4px;font-weight: bold;background-color: transparent;display: none;"><i class="mdi mdi-delete" style="vertical-align: middle;margin-left: 0px;"></i>{!! trans('messages.eliminar') !!}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- Tab de Videos-->
                    <?php if ($data['tipo']=='V') : ?>
                    <div class="tab-pane fade show active" id="video" role="tabpanel" aria-labelledby="video-tab">
                        <div class="row">
                                                <div class="col-lg-3" id="imagenes-content" style="border-right: 1px solid #b9b9b9; max-height: 650px;overflow: auto;">
                                                    <div class="row" style="margin-left: 0px;">
                                                        <table class="table">
                                                          <thead>
                                                            <tr>
                                                              <th scope="col">Atributos</th>
                                                              <th scope="col">Detalle</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <tr>
                                                              <td width="10%">URL</td>
                                                              <td><div style="width: 120px"><?php echo env('APP_ADMIN') . "/archivos/videos_medios/" . $data['archivo']; ?></div></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Ancho</td>
                                                              <td>---</td>
                                                            </tr>
                                                            <tr>
                                                              <td>Alto</td>
                                                              <td>---</td>
                                                            </tr>
                                                            <tr>
                                                            <td>Extensión</td>
                                                              <td><?php echo $data['extension']; ?></td>
                                                            </tr>

                                                          </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                            <div class="col-lg-9" style="padding-right: 23px;">
                                <input type="hidden" id='Vid'>
                                <div class="row">
                                    <div class="col-lg-12" style="border-bottom: 1px solid #b9b9b9;padding-bottom: 10px;padding-top: 10px;">
                                        <label style="margin-top: 10px;">{!! trans('messages.cant_videos') !!}(<span id="counterV"><?php echo count($videos); ?></span>)</label>

                                    </div>
                                    <div class="col-lg-12" style="padding-top: 10px;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>{!! trans('messages.titulo') !!}</label>
                                                <input type="text" class="form-control" id="Vtitulo">
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <div onclick="$('#videoupload').trigger('click');" id="videocontent" style="margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                    <img style="width: 20%;margin-bottom: 10px;" src="<?php echo asset('/images/icons/video.png'); ?>"><br>
                                                    <span style="font-size: 12px;">Subir Video <br> <span style="font-size: 10px;">{!! trans('messages.formatos_videos') !!} </span></span>
                                                </div>
                                                <div onclick="$('#videoupload').trigger('click');" id="uploadedvideo" style="display:none;margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                    <img style="width: 20%;margin-bottom: 10px;" src="<?php echo asset('/images/icons/uploadedvideo.png'); ?>"><br>
                                                    <span style="font-size: 12px;">Video Cargado <br> <span style="font-size: 10px;">{!! trans('messages.des_video') !!} </span></span>
                                                </div>
                                                <!--video id="videovisor" class="video-js" controls preload="auto" style="width: 100%;height: 400px;display: none;" width="400" height="400" poster="" data-setup="{}"></video-->
                                                <div id="videovisor" style="margin-top: 10px;"></div>
                                            </div>
                                            <div class="col-lg-12" style="margin-top: 10px;">
                                                <label>{!! trans('messages.descripcion') !!} </label>
                                                <textarea style="resize: none;height: 100px" class="form-control" id="Vdescripcion"></textarea>
                                            </div>

                                            <div class="col-lg-4" style="margin-top: 10px;">
                                                <label>{!! trans('messages.estado') !!} </label>
                                                <select class="form-control" id="Vestado">
                                                    <option value="A">{!! trans('messages.activo') !!}</option>
                                                    <option value="I">{!! trans('messages.inactivo') !!}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4" style="margin-top: 10px;">
                                                <label>{!! trans('messages.exclusivo') !!} </label>
                                                <select class="form-control" id="Vexclusivo">
                                                    <option value="S">{!! trans('messages.exclusivo') !!} </option>
                                                    <option value="N">{!! trans('messages.no_exclusivo') !!} </option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4" style="margin-top: 10px;">
                                                <label>{!! trans('messages.orden') !!} </label>
                                                <input id="Vorden" value="1" type="number" class="form-control">
                                            </div>
                                            <div class="col-lg-12" style="margin-bottom: 10px;">
                                                <hr>
                                                <input type="file" id="videoupload" style="display: none;">
                                                <button type="button" id="btnSaveV" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #4caf50;font-size: 13px;padding: 10px;border: 1px solid #4caf50;border-radius: 4px;font-weight: bold;background-color: transparent;"><i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i>{!! trans('messages.guardar') !!} </button>
                                                <button type="button" id="btnDelV" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #ff766d;font-size: 13px;padding: 10px;border: 1px solid #ff766d;border-radius: 4px;font-weight: bold;background-color: transparent;display: none;"><i class="mdi mdi-delete" style="vertical-align: middle;margin-left: 0px;"></i>{!! trans('messages.eliminar') !!} </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- Tab de Documentos-->
                    <?php if ($data['tipo']=='F') : ?>
                    <div class="tab-pane fade show active " id="documento" role="tabpanel" aria-labelledby="documento-tab">
                        <div class="row">
                                                <div class="col-lg-3" id="imagenes-content" style="border-right: 1px solid #b9b9b9; max-height: 650px;overflow: auto;">
                                                    <div class="row" style="margin-left: 0px;">
                                                        <table class="table">
                                                          <thead>
                                                            <tr>
                                                              <th scope="col">Atributos</th>
                                                              <th scope="col">Detalle</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <tr>
                                                              <td width="10%">URL</td>
                                                              <td><div style="width: 105px"><?php echo env('APP_ADMIN') . "/archivos/documentos_medios/" . $data['archivo']; ?></div></td>
                                                            </tr>
                                                            <tr>
                                                              <td>Ancho</td>
                                                              <td>---</td>
                                                            </tr>
                                                            <tr>
                                                              <td>Alto</td>
                                                              <td>---</td>
                                                            </tr>
                                                            <tr>
                                                            <td>Extensión</td>
                                                              <td><?php echo $data['extension']; ?></td>
                                                            </tr>

                                                          </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                            <div class="col-lg-9" style="padding-right: 23px;">
                                <input type="hidden" id='Fid'>
                                <div class="row">
                                    <div class="col-lg-12" style="border-bottom: 1px solid #b9b9b9;padding-bottom: 10px;padding-top: 10px;">
                                        <label style="margin-top: 10px;">{!! trans('messages.cant_documentos') !!}(<span id="counterD"><?php echo count($documentos); ?></span>)</label>
                                        <a id="docdownload" style="float: right;margin-right: 10px;font-size: 23px;cursor: pointer;" download target="_blank"><i class="mdi mdi-download"></i></a>
                                        <a id="viewdocument" style="float: right;margin-right: 10px;font-size: 23px;cursor: pointer;"><i class="mdi mdi-window-maximize"></i></a>
                                    </div>
                                    <div class="col-lg-12" style="padding-top: 10px;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>{!! trans('messages.titulo') !!}</label>
                                                <input type="text" class="form-control" id="Ftitulo">
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <div onclick="$('#docupload').trigger('click');" id="doccontent" style="margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                    <img style="width: 20%;margin-bottom: 10px;" src="<?php echo asset('/images/icons/paper.png'); ?>"><br>
                                                    <span style="font-size: 12px;">Subir Documento <br> <span style="font-size: 10px;">{!! trans('messages.formatos_recomendados') !!}</span></span>
                                                </div>
                                                <div onclick="$('#docupload').trigger('click');" id="uploadeddocument" style="display: none;margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                    <img style="width: 71px;margin-bottom: 10px;" src="<?php echo asset('/images/icons/document3.png'); ?>"><br>
                                                    <span style="font-size: 12px;">{!! trans('messages.documento_cargando') !!}<br> <span style="font-size: 10px;">{!! trans('messages.formatos_documento') !!}</span></span>
                                                </div>
                                                <div onclick="$('#docupload').trigger('click');" id="documentpreview" style="display: none;margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                    <img style="width: 71px;margin-bottom: 10px;" id="docextension" src="<?php echo asset('/images/icons/document.png'); ?>"><br>
                                                    <span style="font-size: 12px;"><span id="docname"></span><br> <span style="font-size: 10px;">{!! trans('messages.formatos_documento') !!}</span></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" style="margin-top: 10px;">
                                                <label>{!! trans('messages.descripcion') !!}</label>
                                                <textarea style="resize: none;height: 100px" class="form-control" id="Fdescripcion"></textarea>
                                            </div>

                                            <div class="col-lg-4" style="margin-top: 10px;">
                                                <label>{!! trans('messages.estado') !!}</label>
                                                <select class="form-control" id="Festado">
                                                    <option value="A">{!! trans('messages.activo') !!}</option>
                                                    <option value="I">{!! trans('messages.inactivo') !!}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4" style="margin-top: 10px;">
                                                <label>{!! trans('messages.exclusivo') !!}</label>
                                                <select class="form-control" id="Fexclusivo">
                                                    <option value="S">{!! trans('messages.exclusivo') !!}</option>
                                                    <option value="N">{!! trans('messages.no_exclusivo') !!}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4" style="margin-top: 10px;">
                                                <label>{!! trans('messages.orden') !!}</label>
                                                <input id="Forden" value="1" type="number" class="form-control">
                                            </div>
                                            <div class="col-lg-12" style="margin-bottom: 10px;">
                                                <hr>
                                                <input type="file" id="docupload" style="display: none;">
                                                <button type="button" id="btnSaveF" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #4caf50;font-size: 13px;padding: 10px;border: 1px solid #4caf50;border-radius: 4px;font-weight: bold;background-color: transparent;"><i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i>{!! trans('messages.guardar') !!}</button>
                                                <button type="button" id="btnDelF" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #ff766d;font-size: 13px;padding: 10px;border: 1px solid #ff766d;border-radius: 4px;font-weight: bold;background-color: transparent;display: none;"><i class="mdi mdi-delete" style="vertical-align: middle;margin-left: 0px;"></i>{!! trans('messages.eliminar') !!}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var imagenes = <?php echo json_encode($imagenes); ?>;
    var videos = <?php echo json_encode($videos); ?>;
    var documentos = <?php echo json_encode($documentos); ?>;

    var formMultimedia = new FormData();


    $('#btnSaveI').click(function() {
        procesarMultimedia('I');
    });

    $('#btnSaveV').click(function() {
        procesarMultimedia('V');
    });

    $('#btnSaveF').click(function() {
        procesarMultimedia('F');
    });

    function nuevoArchivoMultimedia(tipo) {

        var formMultimedia = new FormData();

        var last = 0;

        switch (tipo) {
            case 'I':
                $('#mimgcontent').show();
                $('#mimgpreview').hide();
                listado = imagenes;
                break;
            case 'V':
                $('#videocontent').show();
                $('#videovisor').hide();
                $('#uploadedvideo').hide();
                listado = videos;
                break;
            case 'F':
                $('#doccontent').show();
                $('#mimgpreview').hide();
                $('#documentpreview').hide();
                $('#uploadeddocument').hide();
                listado = documentos;
                break;
        }
        if (listado.length > 0) {
            $.each(listado, function(index, item) {
                if (last < item.orden) {
                    last = item.orden
                }
            });
        }

        $('#' + tipo + 'titulo').val("");
        $('#' + tipo + 'descripcion').val("");
        $('#' + tipo + 'orden').val(last + 1);
        $('#' + tipo + 'exclusivo').val("S");
        $('#' + tipo + 'estado').val("A");
        $('#' + tipo + 'id').val("");

        $('#btnDel' + tipo).hide();

    }

    function procesarMultimedia(tipo) {

        formMultimedia.append('tipo', tipo);
        formMultimedia.append('titulo', $('#' + tipo + 'titulo').val());
        formMultimedia.append('descripcion', $('#' + tipo + 'descripcion').val());
        formMultimedia.append('estado', $('#' + tipo + 'estado').val());
        formMultimedia.append('exclusivo', $('#' + tipo + 'exclusivo').val());
        formMultimedia.append('orden', $('#' + tipo + 'orden').val());
        formMultimedia.append('uid', $('#' + tipo + 'id').val());

        $.ajax({
            url: '<?php echo url('cargarmedios'); ?>',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formMultimedia,
            beforeSend: function() {
                $('#btnSave' + tipo).html('Procesando...').attr('disabled', true);
            },
            success: function(response) {
                $('#btnSave' + tipo).html('<i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i> Guardar cambios').attr('disabled', false);
                swal({
                    title: (response.status == 'S') ? '¡Guardado!' : 'Operación Denegada',
                    text: (response.status == 'S') ? 'El archivo ha sido guardada.' : 'No se pudo guardar el archivo',
                    type: (response.status == 'S') ? 'success' : 'info',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    obtenerMultimedia(tipo);
                    switch (tipo) {
                        case 'I':
                            imagenes = response.data;
                            $('#counter' + tipo).html(response.data.length);
                            break;
                        case 'V':
                            videos = response.data;
                            $('#counter' + tipo).html(response.data.length);
                            break;
                        case 'F':
                            documentos = response.data;
                            $('#counter' + tipo).html(response.data.length);
                            break;
                    }

                    seleccionarMultimedia(response.id, tipo);
                    var formMultimedia = new FormData();
                });
            },
            error: function() {
                $('#btnSave' + tipo).html('<i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i> Guardar cambios').attr('disabled', false);
                swal({
                    title: 'Operación Denegada',
                    text: 'Ha ocurrido un problema en el proceso',
                    type: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

    function obtenerMultimedia(tipo) {

        switch (tipo) {
            case 'I':
                var content = '#imagenes-content';
                break;
            case 'V':
                var content = '#videos-content';
                break;
            case 'F':
                var content = '#documentos-content';
                break;
        }

        $.ajax({
            url: '<?php echo url('obtenermultimediamedios'); ?>',
            type: 'POST',
            data: {
                tipo: tipo
            },
            beforeSend: function() {
                $(content).html("<div class='d-flex justify-content-center'><div class='spinner-border text-primary m-5' role='status'><span class='sr-only'>Cargando...</span</div></div>");
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
                $(content).html("<div class='text-center' style='padding-top: 10px; font-size: 11px'>Error al cargar</div>");
            }
        });
    }

    function seleccionarMultimedia(id, tipo) {
        var data = [];
        var dir = '';
        switch (tipo) {
            case 'I':
                listado = imagenes;
                dir = '<?php echo asset('/archivos/imagenes_medios/'); ?>';
                break;
            case 'V':
                listado = videos;
                dir = '<?php echo asset('/archivos/videos_medios/'); ?>';
                break;
            case 'F':
                listado = documentos;
                dir = '<?php echo asset('/archivos/documentos_medios/'); ?>';
                break;
        }

        $.each(listado, function(index, item) {
            if (item.id == id) {
                data = item;
            }
        });

        if (data) {

            $('#' + tipo + 'titulo').val(data.titulo);
            $('#' + tipo + 'descripcion').val(data.descripcion);
            $('#' + tipo + 'orden').val(data.orden);
            $('#' + tipo + 'exclusivo').val(data.exclusivo);
            $('#' + tipo + 'estado').val(data.estado);
            $('#' + tipo + 'id').val(data.id);

            $('#btnDel' + tipo).attr('onclick', "eliminarMultimedia(" + data.id + ",'" + tipo + "')");
            $('#btnDel' + tipo).show();

            if (tipo == 'I') {
                $('.imagenitem').removeClass('active');
                $('.imgitem' + data.id).addClass('active');
                if (data.archivo != '') {
                    $('#mimgcontent').hide();
                    $('#mimgpreview').attr('src', dir + '/' + data.archivo + "?" + Math.random());
                    $('#mimgpreview').show();
                }
            }
            if (tipo == 'V') {
                $('.videositem').removeClass('active');
                $('.videoitem' + data.id).addClass('active');
                $('#uploadedvideo').hide();
                if (data.archivo != '') {
                    $('#videocontent').hide();
                    var video = document.createElement('video');
                    video.className = 'video-js';
                    video.setAttribute('controls', false);
                    // video.setAttribute('preload', 'auto');
                    // video.setAttribute('poster', 'auto');
                    video.setAttribute('data-setup', '{}');
                    video.style.cssText = 'width:100%; height: 300px';
                    $('#videovisor').html(video);
                    addSourceToVideo(video, dir + '/' + data.archivo, 'video/' + data.extension);
                    $('#videovisor').show();
                }
            }
            if (tipo == 'F') {
                $('.documentoitem').removeClass('active');
                $('.docitem' + data.id).addClass('active');
                $('#doccontent').hide();
                $('#uploadeddocument').hide();
                var icon = 'document';
                if (data.extension == 'doc' || data.extension == 'docx') {
                    icon = 'word';
                }
                if (data.extension == 'xls' || data.extension == 'xlsx') {
                    icon = 'excel';
                }
                if (data.extension == 'ppt' || data.extension == 'pptx') {
                    icon = 'powerpoint';
                }
                if (data.extension == 'pdf') {
                    icon = 'pdf';
                }

                $('#viewdocument').attr('onclick', "vistaprevia('" + dir + '/' + data.archivo + "','" + data.extension + "')");
                $('#docdownload').attr('href', dir + '/' + data.archivo);
                $('#docextension').attr('src', '<?php echo asset("/images/icons/"); ?>/' + icon + '.png');
                $('#docname').html(data.originalname);
                $('#documentpreview').show();
            }
        } else {
            nuevoArchivoMultimedia(tipo);
        }
    }

    $(document).ready(function() {

        if (imagenes.length > 0) {
            seleccionarMultimedia(imagenes[0].id, 'I');
        }
        if (videos.length > 0) {
            seleccionarMultimedia(videos[0].id, 'V');
        }
        if (documentos.length > 0) {
            seleccionarMultimedia(documentos[0].id, 'F');
        }

        $('#imgupload').change(function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.addEventListener('load', (event) => {
                $('#mimgpreview').attr('src', event.target.result);
                $('#mimgcontent').hide();
                $('#mimgpreview').show();
            });

            var files = $(this).get(0).files;
            formMultimedia.append('adjunto', files[0]);

            reader.readAsDataURL(file);
        });
        $('#videoupload').change(function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.addEventListener('load', (event) => {
                $('#videocontent').hide();
                $('#uploadedvideo').show();
            });

            var files = $(this).get(0).files;
            formMultimedia.append('adjunto', files[0]);

            reader.readAsDataURL(file);

            info('El video ha sido cargado', 'success');
        });
        $('#imagenmasiva').change(function() {

            var formImagenes = new FormData();

            formImagenes.append('id', $('#id').val());

            $.each($(this), function(i, obj) {
                $.each(obj.files, function(j, file) {
                    formImagenes.append('imagenes[' + j + ']', file);
                })
            });

            $.ajax({
                url: '<?php echo url("cargararchivomasivosmulti"); ?>',
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formImagenes,
                beforeSend: function() {

                },
                success: function(response) {
                    swal({
                        title: (response.status == 'S') ? '¡Carga Completa!' : 'Operación Denegada',
                        text: (response.status == 'S') ? 'Los archivos han sido cargados.' : 'No se pudieron cargar los archivos',
                        type: (response.status == 'S') ? 'success' : 'info',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (response.status == 'S') {
                            location.reload();
                        }
                    });
                },
                error: function() {

                }
            });
        });
        $('#docupload').change(function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.addEventListener('load', (event) => {
                $('#doccontent').hide();
                $('#uploadeddocument').show();
            });

            var files = $(this).get(0).files;
            formMultimedia.append('adjunto', files[0]);

            reader.readAsDataURL(file);

            info('El documento ha sido cargado', 'success');
        });
        $('#imgfile').change(function() {
            subirdocumento(this, 'I');
        });

        $('#videofile').change(function() {
            subirdocumento(this, 'V');
        });

        $('#documentofile').change(function() {
            subirdocumento(this, 'F');
        });

    });
    function addSourceToVideo(element, src, type) {
        var source = document.createElement('source');

        source.src = src;
        source.type = type;

        element.appendChild(source);
    }
    function subirdocumento(element, tipo) {

        var formData = new FormData();

        var files = $(element).get(0).files;
        formData.append('adjunto', files[0]);

        formData.append('tipo', tipo);

        $.ajax({
            url: '<?php echo url("cargarmedios"); ?>',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: function() {

            },
            success: function(view) {

            },
            error: function() {

            }
        });

    }

        function eliminarMultimedia(id, tipo) {
        swal({
            title: '¿Seguro desea eliminar el archivo multimedia seleccionado?',
            type: 'warning',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            showCancelButton: true,
            confirmButtonText: '¡Eliminar!',
        }).then((result) => {
            if (result.value) {
                $.post('<?php echo url('eliminarmultimedio') ?>', {
                    id: id,
                    tipo: tipo
                }, function(response) {

                    swal({
                        title: (response.status == 'S') ? '¡Eliminado!' : 'Operación Denegada',
                        text: (response.status == 'S') ? 'El archivo ha sido eliminado.' : 'No se pudo eliminar el archivo',
                        type: (response.status == 'S') ? 'success' : 'info',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (response.status == 'S') {
                            obtenerMultimedia(tipo);
                            if (response.data.length > 0) {
                                switch (tipo) {
                                    case 'I':
                                        imagenes = response.data;
                                        $('#counter' + tipo).html(response.data.length);
                                        seleccionarMultimedia(imagenes[0].id, tipo);
                                        break;
                                    case 'V':
                                        videos = response.data;
                                        $('#counter' + tipo).html(response.data.length);
                                        seleccionarMultimedia(videos[0].id, tipo);
                                        break;
                                    case 'F':
                                        documentos = response.data;
                                        $('#counter' + tipo).html(response.data.length);
                                        seleccionarMultimedia(documentos[0].id, tipo);
                                        break;
                                }
                            } else {
                                $('#counter' + tipo).html(response.data.length);
                                nuevoArchivoMultimedia(tipo);
                            }

                        }
                    });

                }).fail(function() {
                    swal({
                        title: 'Operación Denegada',
                        text: 'Ha ocurrido un problema en el proceso',
                        type: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        });
    }
</script>