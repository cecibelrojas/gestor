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
                                <h4 class="card-title" style="margin: 0px">Material Mutimedia</h4><br>
                                <p class="card-description" style="font-size: 12px;">Agrega videos, imagenes o documentos</p>
                                <div id="multimedia-content">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="imagen-tab" data-toggle="tab" href="#imagen" role="tab" aria-controls="imagen" aria-selected="true">Imagen</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">Videos</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="documento-tab" data-toggle="tab" href="#documento" role="tab" aria-controls="documento" aria-selected="false">Documentos</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent" style="padding: 0px">
                                        <!-- Tab de Imagenes-->
                                        <div class="tab-pane fade show active" id="imagen" role="tabpanel" aria-labelledby="imagen-tab">
                                            <div class="row">
                                                <div class="col-lg-3" id="imagenes-content" style="border-right: 1px solid #b9b9b9; max-height: 650px;overflow: auto;">
                                                    <div class="row" style="margin-left: 0px;">
                                                        <?php if (count($imagenes) > 0) : ?>
                                                            <?php foreach ($imagenes as $index => $key) : ?>
                                                                <a style="display: none;" class="example-image-link<?php echo $index; ?>" href="<?php echo asset('/archivos/imagenes/' . $id . '/' . $key['archivo']); ?>" data-lightbox="example-set" data-title="">
                                                                    <div class="example-image" style="background-image: url('<?php echo asset('/archivos/imagenes/' . $id . '/' . $key['archivo']); ?>');height: 130px;background-size: cover;background-repeat: no-repeat;background-position: center center; border: 1px solid #ffffff;border-radius: 2px;"></div>
                                                                </a>
                                                                <div onclick="seleccionarMultimedia(<?php echo $key['id']; ?>,'I');" class="col-lg-12 multiitem imagenitem imgitem<?php echo $key['id']; ?> <?php echo ($index == 0) ? "active" : ""; ?>" style="cursor: pointer;border-bottom: 1px solid #b9b9b9;">
                                                                    <div class="text-center" style="padding-top: 25px;">
                                                                        <img style="width: 45px;" src="<?php echo asset('/images/icons/imagen2.png'); ?>">
                                                                        <p style="margin-top: 10px;font-size: 11px;line-height: 1;"><?php echo !empty($key['titulo']) ? $key['titulo'] : 'Imagen sin título'; ?><br>
                                                                            <?php if (!empty($key['extension'])) : ?>
                                                                                <em style="font-size: 9px;"><?php echo $key['extension']; ?></em>
                                                                            <?php endif; ?>
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else : ?>
                                                            <div class="col-lg-12 multiitem imagenitem active" style="cursor: pointer;border-bottom: 1px solid #b9b9b9;">
                                                                <div class="text-center" style="padding-top: 25px;">
                                                                    <img style="width: 45px;" src="<?php echo asset('/images/icons/imagen2.png'); ?>">
                                                                    <p style="margin-top: 10px;font-size: 11px;line-height: 1;">Nueva Imagen</p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9" style="padding-right: 23px;">
                                                    <input type="hidden" id='Iid'>
                                                    <div class="row">
                                                        <div class="col-lg-12" style="border-bottom: 1px solid #b9b9b9;padding-bottom: 10px;padding-top: 10px;">
                                                            <label style="margin-top: 10px;">Cant. Imagenes(<span id="counterI"><?php echo count($imagenes); ?></span>)</label>
                                                            <button type="button" class="btn btn-primary" onclick="nuevoArchivoMultimedia('I')" style="text-decoration: none;cursor: pointer;color: #0090e7;font-size: 13px;padding: 10px;border: 1px solid #0090e7;border-radius: 4px;font-weight: bold;background-color: transparent;float: right;"><i class="mdi mdi-plus-circle-outline" style="vertical-align: middle;margin-right: 0px;"></i> Nueva Imagen</button>
                                                            <button type="button" class="btn btn-primary" onclick="$('#imagenmasiva').trigger('click')" style="margin-right: 5px;text-decoration: none;cursor: pointer;color: #0090e7;font-size: 13px;padding: 10px;border: 1px solid #0090e7;border-radius: 4px;font-weight: bold;background-color: transparent;float: right;"><i class="mdi mdi-plus-circle-outline" style="vertical-align: middle;margin-right: 0px;"></i> Cargar Imagen</button>
                                                            <input type="file" id="imagenmasiva" style="display: none;" multiple>
                                                            <i style="float: right;margin-right: 10px;font-size: 23px;cursor: pointer;" onclick="$('.example-image-link0').trigger('click');" class="mdi mdi-view-carousel"></i>
                                                        </div>
                                                        <div class="col-lg-12" style="padding-top: 10px;">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label>Título</label>
                                                                    <input type="text" class="form-control" id="Ititulo">
                                                                </div>
                                                                <div class="col-lg-12 text-center">
                                                                    <div onclick="$('#imgupload').trigger('click');" id="mimgcontent" style="margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                                        <img style="width: 20%;margin-bottom: 10px;" src="<?php echo asset('/images/icons/add-image.png'); ?>"><br>
                                                                        <span style="font-size: 12px;">Subir Imagen <br> <span style="font-size: 10px;">formatos recomendados jpg, png.</span></span>
                                                                    </div>
                                                                    <img onclick="$('#imgupload').trigger('click');" id="mimgpreview" style="display: none;width: 100%;margin-bottom: 10px;margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;cursor: pointer;" src="<?php echo asset('/images/icons/add-image.png'); ?>">
                                                                </div>
                                                                <div class="col-lg-12" style="margin-top: 10px;">
                                                                    <label>Descripción</label>
                                                                    <textarea style="resize: none;height: 100px" class="form-control" id="Idescripcion"></textarea>
                                                                </div>

                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Estado</label>
                                                                    <select class="form-control" id="Iestado">
                                                                        <option value="A">Activo</option>
                                                                        <option value="I">Inactivo</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Exclusivo</label>
                                                                    <select class="form-control" id="Iexclusivo">
                                                                        <option value="S">Exclusivo</option>
                                                                        <option value="N">No Exclusivo</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Orden</label>
                                                                    <input id="Iorden" value="1" type="number" class="form-control">
                                                                </div>
                                                                <div class="col-lg-12" style="margin-bottom: 10px;">
                                                                    <hr>
                                                                    <input type="file" id="imgupload" style="display: none;">
                                                                    <button type="button" id="btnSaveI" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #4caf50;font-size: 13px;padding: 10px;border: 1px solid #4caf50;border-radius: 4px;font-weight: bold;background-color: transparent;"><i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i>Guardar</button>
                                                                    <button type="button" id="btnDelI" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #ff766d;font-size: 13px;padding: 10px;border: 1px solid #ff766d;border-radius: 4px;font-weight: bold;background-color: transparent;display: none;"><i class="mdi mdi-delete" style="vertical-align: middle;margin-left: 0px;"></i>Eliminar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tab de Videos-->
                                        <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                                            <div class="row">
                                                <div class="col-lg-3" id="videos-content" style="border-right: 1px solid #b9b9b9">
                                                    <div class="row" style="margin-left: 0px;">
                                                        <?php if (count($videos) > 0) : ?>
                                                            <?php foreach ($videos as $index => $key) : ?>
                                                                <div onclick="seleccionarMultimedia(<?php echo $key['id']; ?>,'V')" class="col-lg-12 multiitem videositem videoitem<?php echo $key['id']; ?> <?php echo ($index == 0) ? "active" : ""; ?>" onclick="openimagen(<?php echo $key['id']; ?>);" style="cursor: pointer;border-bottom: 1px solid #b9b9b9;">
                                                                    <div class="text-center" style="padding-top: 25px;">
                                                                        <img style="width: 45px;" src="<?php echo asset('/images/icons/add-video.png'); ?>">
                                                                        <p style="margin-top: 10px;font-size: 11px;line-height: 1;"><?php echo !empty($key['titulo']) ? $key['titulo'] : 'Imagen sin título'; ?><br>
                                                                            <?php if (!empty($key['extension'])) : ?>
                                                                                <em style="font-size: 9px;"><?php echo $key['extension']; ?></em>
                                                                            <?php endif; ?>
                                                                        </p>

                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else : ?>
                                                            <div class="col-lg-12 multiitem imagenitem active" style="cursor: pointer;border-bottom: 1px solid #b9b9b9;">
                                                                <div class="text-center" style="padding-top: 25px;">
                                                                    <img style="width: 45px;" src="<?php echo asset('/images/icons/add-video.png'); ?>">
                                                                    <p style="margin-top: 10px;font-size: 11px;line-height: 1;">{!! trans('messages.nuevo_video') !!}</p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9" style="padding-right: 23px;">
                                                    <input type="hidden" id='Vid'>
                                                    <div class="row">
                                                        <div class="col-lg-12" style="border-bottom: 1px solid #b9b9b9;padding-bottom: 10px;padding-top: 10px;">
                                                            <label style="margin-top: 10px;">{!! trans('messages.cant_videos') !!}(<span id="counterV"><?php echo count($videos); ?></span>)</label>
                                                            <button type="button" class="btn btn-primary" onclick="nuevoArchivoMultimedia('V')" style="text-decoration: none;cursor: pointer;color: #0090e7;font-size: 13px;padding: 10px;border: 1px solid #0090e7;border-radius: 4px;font-weight: bold;background-color: transparent;float: right;"><i class="mdi mdi-plus-circle-outline" style="vertical-align: middle;margin-right: 0px;"></i> {!! trans('messages.nuevo_video') !!}</button>
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
                                        <!-- Tab de Documentos-->
                                        <div class="tab-pane fade" id="documento" role="tabpanel" aria-labelledby="documento-tab">
                                            <div class="row">
                                                <div class="col-lg-3" id="documentos-content" style="border-right: 1px solid #b9b9b9">
                                                    <div class="row" style="margin-left: 0px;">
                                                        <?php if (count($documentos) > 0) : ?>
                                                            <?php foreach ($documentos as $index => $key) : ?>
                                                                <div onclick="seleccionarMultimedia(<?php echo $key['id']; ?>,'F')" class="col-lg-12 multiitem documentoitem docitem<?php echo $key['id']; ?> <?php echo ($index == 0) ? "active" : ""; ?>" onclick="opendocumento(<?php echo $key['id']; ?>);" style="cursor: pointer;border-bottom: 1px solid #b9b9b9;">
                                                                    <div class="text-center" style="padding-top: 25px;">
                                                                        <img style="width: 45px;" src="<?php echo asset('/images/icons/document2.png'); ?>">
                                                                        <p style="margin-top: 10px;font-size: 11px;line-height: 1;"><?php echo !empty($key['titulo']) ? $key['titulo'] : 'Documento sin título'; ?><br>
                                                                            <?php if (!empty($key['extension'])) : ?>
                                                                                <em style="font-size: 9px;"><?php echo $key['extension']; ?></em>
                                                                            <?php endif; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else : ?>
                                                            <div class="col-lg-12 multiitem imagenitem active" style="cursor: pointer;border-bottom: 1px solid #b9b9b9;">
                                                                <div class="text-center" style="padding-top: 25px;">
                                                                    <img style="width: 45px;" src="<?php echo asset('/images/icons/document2.png'); ?>">
                                                                    <p style="margin-top: 10px;font-size: 11px;line-height: 1;">{!! trans('messages.nuevo_documento') !!}</p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9" style="padding-right: 23px;">
                                                    <input type="hidden" id='Fid'>
                                                    <div class="row">
                                                        <div class="col-lg-12" style="border-bottom: 1px solid #b9b9b9;padding-bottom: 10px;padding-top: 10px;">
                                                            <label style="margin-top: 10px;">{!! trans('messages.cant_documentos') !!}(<span id="counterD"><?php echo count($documentos); ?></span>)</label>
                                                            <button type="button" class="btn btn-primary" onclick="nuevoArchivoMultimedia('F')" style="text-decoration: none;cursor: pointer;color: #0090e7;font-size: 13px;padding: 10px;border: 1px solid #0090e7;border-radius: 4px;font-weight: bold;background-color: transparent;float: right;"><i class="mdi mdi-plus-circle-outline" style="vertical-align: middle;margin-right: 0px;"></i> {!! trans('messages.nuevo_documento') !!}</button>
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

    function eliminarimagen() {
        swal({
            title: '¿Seguro desea eliminar la imagen seleccionada?',
            text: 'Esta accion puede causar mala impresión en la tienda, se recomienda despublicar el producto antes de proceder',
            type: 'info',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            showCancelButton: true,
            confirmButtonText: '¡Eliminar!',
        }).then((result) => {
            if (result.value) {
                $.post('<?php echo url('eliminarimagen') ?>', {
                    id: producto
                }, function(response) {

                    swal({
                        title: (response.status == 'S') ? '¡Eliminado!' : 'Operación Denegada',
                        text: (response.status == 'S') ? 'El archivo ha sido eliminado.' : 'No se pudo eliminar el archivo',
                        type: (response.status == 'S') ? 'success' : 'info',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (response.status == 'S') {
                            location.reload();
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
    function eliminarvideo() {
        swal({
            title: '¿Seguro desea eliminar el video del producto?',
            text: 'Esta accion puede causar mala impresión en la tienda, se recomienda despublicar el producto antes de proceder',
            type: 'warning',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            showCancelButton: true,
            confirmButtonText: '¡Eliminar!',
        }).then((result) => {
            if (result.value) {
                $.post('<?php echo url('eliminarvideo') ?>', {
                    id: producto
                }, function(response) {

                    swal({
                        title: (response.status == 'S') ? '¡Eliminado!' : 'Operación Denegada',
                        text: (response.status == 'S') ? 'El archivo ha sido eliminado.' : 'No se pudo eliminar el archivo',
                        type: (response.status == 'S') ? 'success' : 'info',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (response.status == 'S') {
                            location.reload();
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
        function eliminararchivo(id) {
        swal({
            title: '¿Seguro desea eliminar el archivo seleccionado?',
            text: 'Esta accion puede causar mala impresión en la tienda, se recomienda despublicar el producto antes de proceder',
            type: 'warning',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            showCancelButton: true,
            confirmButtonText: '¡Eliminar!',
        }).then((result) => {
            if (result.value) {
                $.post('<?php echo url('eliminarmultimedia') ?>', {
                    id: id,
                    producto_id: producto
                }, function(response) {
                    swal({
                        title: (response.status == 'S') ? '¡Eliminado!' : 'Operación Denegada',
                        text: (response.status == 'S') ? 'El archivo ha sido eliminado.' : 'No se pudo eliminar el archivo',
                        type: (response.status == 'S') ? 'success' : 'info',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (response.status == 'S') {
                            location.reload();
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
        function actualizararchivo(element, id) {

        var exclusivo = 'N';
        if ($(element).is(':checked')) {
            exclusivo = 'S';
        }

        $.post('<?php echo url('actualizarmultimedia') ?>', {
            id: id,
            exclusivo: exclusivo
        }, function(response) {

        });
    }
        function actualizarpreview(element, id) {

        var formData = new FormData();

        var files = $(element).get(0).files;
        formData.append('adjunto', files[0]);
        formData.append('id', id);
        formData.append('producto_id', producto);

        $.ajax({
            url: '<?php echo url("actualizarmultimedia"); ?>',
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
        function info(msj, type) {
        swal({
            title: 'Información',
            text: msj,
            type: type,
            showConfirmButton: false,
            timer: 1500
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
            url: '<?php echo url('obtenermultimedia'); ?>',
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
                dir = '<?php echo asset('/archivos/imagenes/'); ?>';
                break;
            case 'V':
                listado = videos;
                dir = '<?php echo asset('/archivos/videos/'); ?>';
                break;
            case 'F':
                listado = documentos;
                dir = '<?php echo asset('/archivos/documentos/'); ?>';
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
                    $('#mimgpreview').attr('src', dir + '/' + producto + '/' + data.archivo);
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
                    addSourceToVideo(video, dir + '/' + producto + '/' + data.archivo, 'video/' + data.extension);
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

                $('#viewdocument').attr('onclick', "vistaprevia('" + dir + '/' + producto + '/' + data.archivo + "','" + data.extension + "')");
                $('#docdownload').attr('href', dir + '/' + producto + '/' + data.archivo);
                $('#docextension').attr('src', '<?php echo asset("/images/icons/"); ?>/' + icon + '.png');
                $('#docname').html(data.originalname);
                $('#documentpreview').show();
            }
        } else {
            nuevoArchivoMultimedia(tipo);
        }
    }
        function addSourceToVideo(element, src, type) {
        var source = document.createElement('source');

        source.src = src;
        source.type = type;

        element.appendChild(source);
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
                $.post('<?php echo url('eliminarmultimedia') ?>', {
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

            formImagenes.append('id', producto);

            $.each($(this), function(i, obj) {
                $.each(obj.files, function(j, file) {
                    formImagenes.append('imagenes[' + j + ']', file);
                })
            });

            $.ajax({
                url: '<?php echo url("cargararchivomasivos"); ?>',
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
    function subirdocumento(element, tipo) {

        var formData = new FormData();

        var files = $(element).get(0).files;
        formData.append('adjunto', files[0]);

        formData.append('tipo', tipo);
        formData.append('id', producto);

        $.ajax({
            url: '<?php echo url("cargararchivo"); ?>',
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
    function vistaprevia(src, extension) {

        if ($.inArray(extension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx']) != -1) {
            var file = src + "&embedded=true";
            src = "https://view.officeapps.live.com/op/embed.aspx?src=" + file;
        }

        $.fancybox.open({
            src: src,
            type: 'iframe',
            buttons: ['fullScreen', 'close']
        }, {
            rotate: true
        });

        $('.fancybox-container').css('z-index', '999999999999');

    }
</script>
