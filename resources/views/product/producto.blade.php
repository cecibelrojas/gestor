@extends('layouts.administrador')

@section('content')

<style>
    #formProducto .nav-link {
        font-size: 12px !important;
        background-color: #fff !important;
        color: <?php echo env('COLOR_BG_PRIMARY') ?> !important;
        border-bottom: 2px solid <?php echo env('COLOR_BG_PRIMARY') ?>;
    }

    #formProducto .nav-link.active {
        background-color: <?php echo env('COLOR_BG_PRIMARY') ?> !important;
        color: <?php echo env('COLOR_TEXT_PRIMARY') ?> !important;
    }

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

    .tag {
        background-color: <?php echo env('COLOR_BG_TERTIARY') ?> !important;
        color: <?php echo env('COLOR_TEXT_TERTIARY') ?> !important;
        font-size: 12px;
        padding: 5px;
        border-radius: 4px;
    }

    .tox-tinymce {
        height: 650px !important;
    }
</style>
<div class="card-header">
    <div class="row">
        <div class="col-lg-11">
            <button class="btn btn-sm btn-info text-left" onclick="location.href='<?php echo url('/publicacion'); ?>'"><i class="fa fa-plus-circle"></i> Nueva Publicación</button>
            <?php if ($data) : ?>
                <a class="btn btn-info btn-sm" type="button" style="text-decoration: none;cursor: pointer;color: #8f5fe8;font-size: 13px;border: 1px solid #8f5fe8;border-radius: 4px;font-weight: bold;background-color: transparent;" target="_blank" href="<?php echo env('APP_URL_FRONT') . "/publicacion/" . $id; ?>" style="float: left;"><i class="fa fa-eye" style="vertical-align: middle;"></i> Ver Publicación</a>
            <?php endif; ?>
        </div>
        <div class="col-lg-1">
            <?php if ($data) : ?>
                <div style="border: 1px solid #00bcd4;text-align: center;font-size: 14px;padding: 3px;border-radius: 4px;color: #00bcd4;cursor: pointer;font-weight: bold;">ID: <?php echo $id; ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<form id="formProducto" method="POST" action="{{ url('guardarproducto') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="id" name="id" value="<?php echo @$data['id']; ?>">

    <div class="row" style="margin-right: 0px !important; margin-left: -4px !important;">
        <div class="col-lg-8">

            <div class="row">
                <div class="col-lg-12" style="margin-bottom: 10px">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title" style="margin: 0px">Titulo</h4>
                            <input type="text" class="form-control" style="margin-top: 10px;" name="nombre" id="nombre" value="{{ @$data->nombre}}" required maxlength="170" onkeyup="countChars(this);">
                            <p id="charNum" style="text-align: right;">170 caracteres restantes</p>
                            <h4 class="card-title" style="margin: 0px">Sumario</h4>
                            <input type="text" name="sumario" id="sumario" class="form-control" value="{{ @$data->sumario }}" style="border: 1px solid #b9b9b9;" maxlength="320" onkeyup="countCharsSumario(this);">
                            <p id="charNumSumario" style="text-align: right;">320 caracteres restantes</p>
                            <textarea id="descripcion" class="form-control" name="descripcion">{{ @$data->descripcion }}</textarea>
                        </div>
                    </div>
                </div>
                <?php if ($data) : ?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="margin: 0px">Material Multimedia</h4><br>
                                <p class="card-description" style="font-size: 12px;">Agrega videos, imagenes o documentos a tu producto.</p>
                                <div id="multimedia-content">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="imagen-tab" data-toggle="tab" href="#imagen" role="tab" aria-controls="imagen" aria-selected="true">Imagenes</a>
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
                                                                    <button type="button" id="btnSaveI" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #4caf50;font-size: 13px;padding: 10px;border: 1px solid #4caf50;border-radius: 4px;font-weight: bold;background-color: transparent;"><i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i>Guardar cambios</button>
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
                                                                    <p style="margin-top: 10px;font-size: 11px;line-height: 1;">Nuevo Video</p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9" style="padding-right: 23px;">
                                                    <input type="hidden" id='Vid'>
                                                    <div class="row">
                                                        <div class="col-lg-12" style="border-bottom: 1px solid #b9b9b9;padding-bottom: 10px;padding-top: 10px;">
                                                            <label style="margin-top: 10px;">Cant. Videos(<span id="counterV"><?php echo count($videos); ?></span>)</label>
                                                            <button type="button" class="btn btn-primary" onclick="nuevoArchivoMultimedia('V')" style="text-decoration: none;cursor: pointer;color: #0090e7;font-size: 13px;padding: 10px;border: 1px solid #0090e7;border-radius: 4px;font-weight: bold;background-color: transparent;float: right;"><i class="mdi mdi-plus-circle-outline" style="vertical-align: middle;margin-right: 0px;"></i> Nuevo Video</button>
                                                        </div>
                                                        <div class="col-lg-12" style="padding-top: 10px;">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label>Título</label>
                                                                    <input type="text" class="form-control" id="Vtitulo">
                                                                </div>
                                                                <div class="col-lg-12 text-center">
                                                                    <div onclick="$('#videoupload').trigger('click');" id="videocontent" style="margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                                        <img style="width: 20%;margin-bottom: 10px;" src="<?php echo asset('/images/icons/video.png'); ?>"><br>
                                                                        <span style="font-size: 12px;">Subir Video <br> <span style="font-size: 10px;">formatos recomendados mp4, avi.</span></span>
                                                                    </div>
                                                                    <div onclick="$('#videoupload').trigger('click');" id="uploadedvideo" style="display:none;margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                                        <img style="width: 20%;margin-bottom: 10px;" src="<?php echo asset('/images/icons/uploadedvideo.png'); ?>"><br>
                                                                        <span style="font-size: 12px;">Video Cargado <br> <span style="font-size: 10px;">Click aquí para reemplazar video.</span></span>
                                                                    </div>
                                                                    <!--video id="videovisor" class="video-js" controls preload="auto" style="width: 100%;height: 400px;display: none;" width="400" height="400" poster="" data-setup="{}"></video-->
                                                                    <div id="videovisor" style="margin-top: 10px;"></div>
                                                                </div>
                                                                <div class="col-lg-12" style="margin-top: 10px;">
                                                                    <label>Descripción</label>
                                                                    <textarea style="resize: none;height: 100px" class="form-control" id="Vdescripcion"></textarea>
                                                                </div>

                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Estado</label>
                                                                    <select class="form-control" id="Vestado">
                                                                        <option value="A">Activo</option>
                                                                        <option value="I">Inactivo</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Exclusivo</label>
                                                                    <select class="form-control" id="Vexclusivo">
                                                                        <option value="S">Exclusivo</option>
                                                                        <option value="N">No Exclusivo</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Orden</label>
                                                                    <input id="Vorden" value="1" type="number" class="form-control">
                                                                </div>
                                                                <div class="col-lg-12" style="margin-bottom: 10px;">
                                                                    <hr>
                                                                    <input type="file" id="videoupload" style="display: none;">
                                                                    <button type="button" id="btnSaveV" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #4caf50;font-size: 13px;padding: 10px;border: 1px solid #4caf50;border-radius: 4px;font-weight: bold;background-color: transparent;"><i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i>Guardar cambios</button>
                                                                    <button type="button" id="btnDelV" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #ff766d;font-size: 13px;padding: 10px;border: 1px solid #ff766d;border-radius: 4px;font-weight: bold;background-color: transparent;display: none;"><i class="mdi mdi-delete" style="vertical-align: middle;margin-left: 0px;"></i>Eliminar</button>
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
                                                                    <p style="margin-top: 10px;font-size: 11px;line-height: 1;">Nuevo Documento</p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9" style="padding-right: 23px;">
                                                    <input type="hidden" id='Fid'>
                                                    <div class="row">
                                                        <div class="col-lg-12" style="border-bottom: 1px solid #b9b9b9;padding-bottom: 10px;padding-top: 10px;">
                                                            <label style="margin-top: 10px;">Cant. Documentos(<span id="counterD"><?php echo count($documentos); ?></span>)</label>
                                                            <button type="button" class="btn btn-primary" onclick="nuevoArchivoMultimedia('F')" style="text-decoration: none;cursor: pointer;color: #0090e7;font-size: 13px;padding: 10px;border: 1px solid #0090e7;border-radius: 4px;font-weight: bold;background-color: transparent;float: right;"><i class="mdi mdi-plus-circle-outline" style="vertical-align: middle;margin-right: 0px;"></i> Nuevo Documento</button>
                                                            <a id="docdownload" style="float: right;margin-right: 10px;font-size: 23px;cursor: pointer;" download target="_blank"><i class="mdi mdi-download"></i></a>
                                                            <a id="viewdocument" style="float: right;margin-right: 10px;font-size: 23px;cursor: pointer;"><i class="mdi mdi-window-maximize"></i></a>
                                                        </div>
                                                        <div class="col-lg-12" style="padding-top: 10px;">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label>Título</label>
                                                                    <input type="text" class="form-control" id="Ftitulo">
                                                                </div>
                                                                <div class="col-lg-12 text-center">
                                                                    <div onclick="$('#docupload').trigger('click');" id="doccontent" style="margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                                        <img style="width: 20%;margin-bottom: 10px;" src="<?php echo asset('/images/icons/paper.png'); ?>"><br>
                                                                        <span style="font-size: 12px;">Subir Documento <br> <span style="font-size: 10px;">formatos recomendados pdf, docx, xlsx, pptx.</span></span>
                                                                    </div>
                                                                    <div onclick="$('#docupload').trigger('click');" id="uploadeddocument" style="display: none;margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                                        <img style="width: 71px;margin-bottom: 10px;" src="<?php echo asset('/images/icons/document3.png'); ?>"><br>
                                                                        <span style="font-size: 12px;">Documento Cargado<br> <span style="font-size: 10px;">Click aquí para reemplazar documento.</span></span>
                                                                    </div>
                                                                    <div onclick="$('#docupload').trigger('click');" id="documentpreview" style="display: none;margin-top: 10px;border-radius: 4px;border: 1px solid #15d0c2;padding: 15px;line-height: 1;cursor: pointer;">
                                                                        <img style="width: 71px;margin-bottom: 10px;" id="docextension" src="<?php echo asset('/images/icons/document.png'); ?>"><br>
                                                                        <span style="font-size: 12px;"><span id="docname"></span><br> <span style="font-size: 10px;">Click aquí para reemplazar documento.</span></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12" style="margin-top: 10px;">
                                                                    <label>Descripción</label>
                                                                    <textarea style="resize: none;height: 100px" class="form-control" id="Fdescripcion"></textarea>
                                                                </div>

                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Estado</label>
                                                                    <select class="form-control" id="Festado">
                                                                        <option value="A">Activo</option>
                                                                        <option value="I">Inactivo</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Exclusivo</label>
                                                                    <select class="form-control" id="Fexclusivo">
                                                                        <option value="S">Exclusivo</option>
                                                                        <option value="N">No Exclusivo</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-4" style="margin-top: 10px;">
                                                                    <label>Orden</label>
                                                                    <input id="Forden" value="1" type="number" class="form-control">
                                                                </div>
                                                                <div class="col-lg-12" style="margin-bottom: 10px;">
                                                                    <hr>
                                                                    <input type="file" id="docupload" style="display: none;">
                                                                    <button type="button" id="btnSaveF" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #4caf50;font-size: 13px;padding: 10px;border: 1px solid #4caf50;border-radius: 4px;font-weight: bold;background-color: transparent;"><i class="mdi mdi-content-save" style="vertical-align: middle;margin-left: 0px;"></i>Guardar cambios</button>
                                                                    <button type="button" id="btnDelF" class="btn btn-success" style="text-decoration: none;cursor: pointer;color: #ff766d;font-size: 13px;padding: 10px;border: 1px solid #ff766d;border-radius: 4px;font-weight: bold;background-color: transparent;display: none;"><i class="mdi mdi-delete" style="vertical-align: middle;margin-left: 0px;"></i>Eliminar</button>
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
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="estado" style="font-size: 12px;">Estado: </label>
                              <select class="form-control" name="estado" id="estado" style="font-size: 12px;">
                                <?php if (in_array(auth()->user()->rol, array('A', 'C', 'B','E'))) : ?>
                                    <option value="I" <?php echo ($data && $data['estado'] == 'I') ? "selected" : ""; ?>>Borrador</option>
                                <?php endif; ?>
                                <?php if (in_array(auth()->user()->rol, array('A', 'E' , 'B'))) : ?>
                                    <option value="R" <?php echo ($data && $data['estado'] == 'R') ? "selected" : ""; ?>>Para Corrección</option>
                                <?php endif; ?>
                                 <?php if (in_array(auth()->user()->rol, array('A', 'B'))) : ?>
                                    <option value="Z" <?php echo ($data && $data['estado'] == 'Z') ? "selected" : ""; ?>>Para Corrección Voces</option>
                                <?php endif; ?>
                                <?php if (in_array(auth()->user()->rol, array('A','D','E','B'))) : ?>
                                    <option value="P" <?php echo ($data && $data['estado'] == 'P') ? "selected" : ""; ?>>Publicar Corregido</option>
                                <?php endif; ?>
                                <?php if (in_array(auth()->user()->rol, array('V'))) : ?>
                                    <option value="Q" <?php echo ($data && $data['estado'] == 'Q') ? "selected" : ""; ?>> Corregido para Publicar</option>
                                <?php endif; ?>
                                <?php if (in_array(auth()->user()->rol, array('A', 'B' , 'E'))) : ?>
                                    <option value="A" <?php echo ($data && $data['estado'] == 'A') ? "selected" : ""; ?>>Publicar</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label style="font-size: 12px;">Categoria</label>
                            <select class="form-control select2" name="categoria" id="categoria" required>
                                <option value="">Seleccionar</option>
                                <?php if (count($categorias)) : ?>
                                    <?php foreach ($categorias as $key) : ?>
                                        <option <?php echo ($data && $data['categoria'] == $key['id']) ? "selected" : ""; ?> value="<?php echo $key['id']; ?>"><?php echo $key['nombre']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-lg-6" style="margin-top: 10px;line-height: 1;">
                            <p style="margin-bottom: 0px;font-size: 12px;font-weight: bold;">Creador</p>
                            <?php if ($data) : ?>
                                <span style="font-size: 10px;">{{ $data->creador }} <span>({{ $data->created_at}})</span></span><br>
                            <?php else : ?>
                                <span style="font-size: 10px;">{{ auth()->user()->name }} ({{date('Y-m-d')}})</span>
                            <?php endif; ?>
                            <?php if ($data && !empty($data->usumod)) : ?>
                                <br>
                                <p style="margin-bottom: 0px;font-size: 12px;font-weight: bold;">Ult. Actualización</p>
                                <span style="font-size: 10px;">{{ $data->editor }} <span>({{ $data->updated_at}})</span></span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <label style="font-size: 12px;font-weight: bold;">Misión Diplomática</label>
                            <select class="form-control select2" style="border: 1px solid #b9b9b9;" name="id_parroquia">
                                <option value="">Seleccionar</option>
                                <?php if (count($parroquias)) : ?>
                                    <?php foreach ($parroquias as $key) : ?>
                                        <option <?php echo ($data && $data['id_parroquia'] == $key['id_parroquia']) ? "selected" : ""; ?> value="<?php echo $key['id_parroquia']; ?>"><?php echo $key['parroquia']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-lg-5">
                            <label style="font-size: 12px;">Destacado</label><br>
                            <input type="checkbox" name="estdestacado" id="estdestacado" checked data-bootstrap-switch>
                        </div>
                        <div class="col-lg-7">
                            <label style="font-size: 12px;">Actualización<span style="color: red;">&nbsp;Solo para destacados</span> </label><br>
                            <input type="datetime-local" class="form-control input-sm" style="border: 1px solid #b9b9b9;" value="{{ @$data->fecha_destacado}}" name="fecha_destacado" id="fecha_destacado">
                        </div>
                        <div class="col-lg-12">
                            <hr style="margin: 10px 0px">
                            <?php

                            $estadoActual = 'Borrador';
                            if ($data && $data['estado'] == 'R') {
                                $estadoActual = 'Corrección';
                            }
                            if ($data && $data['estado'] == 'Z') {
                                $estadoActual = 'Corrección Voces';
                            }
                            if ($data && $data['estado'] == 'P') {
                                $estadoActual = 'Publicado Corregido';
                            }
                            if ($data && $data['estado'] == 'Q') {
                                $estadoActual = 'Corregido para ser publicado por voces';
                            }
                            if ($data && $data['estado'] == 'A') {
                                $estadoActual = 'Publicado';
                            }

                            $hide = false;
                            if (auth()->user()->rol == 'C') {
                                if ($data && $data['estado'] != 'I') {
                                    $hide = true;
                                }
                            }
                            if (auth()->user()->rol == 'D') {
                                if ($data && $data['estado'] != 'R') {
                                    $hide = true;
                                }
                            }
                            if (auth()->user()->rol == 'V') {
                                if ($data && $data['estado'] != 'Z') {
                                    $hide = true;
                                }
                            }
                            ?>

                            <?php if (isset($id) && !empty($id)) : ?>
                                <button class="btn btn-primary btn-sm" type="submit" style="text-decoration: none;cursor: pointer;color: #0090e7;font-size: 13px;border: 1px solid #0090e7;border-radius: 4px;font-weight: bold;background-color: transparent;float: right;<?php echo $hide ? 'display: none;' : ''; ?>">Actualizar cambios</button>
                            <?php else : ?>
                                <button class="btn btn-success btn-sm" type="submit" style="float: right;color: #fff;border: 1px solid #4caf50;">Guardar</button>
                            <?php endif; ?>
                            <?php if ($data && auth()->user()->rol == 'C' && $data['estado'] != 'I') : ?>
                                <p style="text-align: center;font-size: 11px;margin-bottom: 0px;">* La publicación se encuentra en estado de <?php echo $estadoActual; ?></p>
                            <?php endif; ?>
                            <?php if ($data && auth()->user()->rol == 'D' && $data['estado'] != 'R') : ?>
                                <p style="text-align: center;font-size: 11px;margin-bottom: 0px;">* La publicación se encuentra en estado de <?php echo $estadoActual; ?></p>
                            <?php endif; ?>
                            <?php if ($data && auth()->user()->rol == 'V' && $data['estado'] != 'Z') : ?>
                                <p style="text-align: center;font-size: 11px;margin-bottom: 0px;">* La publicación se encuentra en estado de <?php echo $estadoActual; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="margin-top: 10px;">
                <div class="card-header" style="background-color: <?php echo env("COLOR_BG_SECONDARY"); ?>;color: <?php echo env("COLOR_TEXT_SECONDARY"); ?>;">
                    <h4 class="card-title" style="margin: 0px;font-size: 14px;font-weight: bold;">Propiedades</h4><br>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label style="font-size: 12px;font-weight: bold;">Autor</label>
                            <input type="text" class="form-control" name="nombre_autor" id="nombre_autor" value="{{ @$data->nombre_autor}}" maxlength="100" placeholder="Nombre de Autor">
                        </div>
                        <div class="col-lg-12">
                            <label style="font-size: 12px;font-weight: bold;">Etiquetas</label>
                            <input type="text" value="{{ @$data->etiquetas}}" id="tags" style="border: 1px solid #b9b9b9;" name="etiquetas" value="" data-role="tagsinput" />
                        </div>
                        <div class="col-lg-12">
                            <label style="font-size: 12px;">Fecha Inicio</label><br>
                            <input type="datetime-local" class="form-control input-sm" style="border: 1px solid #b9b9b9;" value="<?php echo $data ? $data['fecini'] : ''; ?>" name="fecini">
                        </div>
                        <div class="col-lg-12">
                            <label style="font-size: 12px;">Fecha Fin</label><br>
                            <input type="datetime-local" class="form-control input-sm" style="border: 1px solid #b9b9b9;" value="<?php echo $data ? $data['fecfin'] : ''; ?>" name="fecfin">
                        </div>
                        <div class="col-lg-6">
                            <label style="font-size: 12px;">Imagen Interna Visible</label><br>
                            <input type="checkbox" class="form-control" name="fotovisible" id="fotovisible" checked data-bootstrap-switch>
                        </div>

                    </div>

                </div>
            </div>

            <div class="card" style="margin-top: 10px;">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="imgdestacado-tab" data-toggle="tab" href="#imgdestacado" role="tab" aria-controls="imgdestacado" aria-selected="true" style="font-size: 12px;">Imagen Destacada</a>
                        </li>
                        <!--li class="nav-item" role="presentation">
                            <a class="nav-link" id="trailer-tab" data-toggle="tab" href="#trailer" role="tab" aria-controls="trailer" aria-selected="false" style="font-size: 12px;">Trailer</a>
                        </li-->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="imgdestacado" role="tabpanel" aria-labelledby="imgdestacado-tab">
                            <div class="row">
                                <div class="col-lg-12 text-center" style="margin-top: 10px;line-height: 1;">
                                    <span style="font-size: 10px;">Agrega una imagen que se visualizara en la publicación.</span><br>
                                    <img onclick="$('#destacado').trigger('click');" src="<?php echo ($data && $data['imgdestacado']) ? asset('/archivos/imagenes/' . $data['imgdestacado']) : asset('/images/icons/add-image2.png'); ?>" id="imgpreview" style="width:<?php echo ($data && $data['imgdestacado']) ? '100' : '50'; ?>%;cursor: pointer;margin-top: 10px;margin-bottom: 10px;">
                                    <input type="file" name="destacado" style="display: none;" id="destacado" class="form-control ">
                                    <?php if ($data && !empty($data['imgdestacado'])) : ?>
                                        <br>
                                        <img src="{{ asset('/images/icons/delete.png') }}" style="cursor: pointer;width: 32px;border: 1px solid #e77056;border-radius: 40px;padding: 4px;background-color: #ffffff;margin-top: 0px;" id="btnDelImagen" onclick="eliminarimagen();">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="trailer" role="tabpanel" aria-labelledby="trailer-tab">
                            <div class="row">
                                <div class="col-lg-12 text-center" style="margin-top: 10px;line-height: 1;">
                                    <span style="font-size: 10px;">Agrega un video trailer que se visualizara en el catalogo de productos.</span><br>

                                    <?php if ($data && $data['trailer']) : ?>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-lg-12">
                                                <video id="my-video" class="video-js" controls preload="auto" width="250" height="230" poster="<?php echo ($data && $data['preview']) ? asset('/archivos/imagenes/' . $data['preview']) : ''; ?>" data-setup="{}">
                                                    <source src="<?php echo asset('/archivos/videos/' . $data['trailer']); ?>" type="video/mp4" />
                                                </video>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <img onclick="$('#ftrailer').trigger('click');" src="<?php echo asset('/images/icons/add-video.png'); ?>" style="width:50%;cursor: pointer;margin-bottom: 10px;margin-top: 20px;">
                                    <?php endif; ?>
                                    <?php if ($data && !empty($data['trailer'])) : ?>
                                        <br>
                                        <img src="{{ asset('/images/icons/delete.png') }}" style="cursor: pointer;width: 32px;border: 1px solid #e77056;border-radius: 40px;padding: 4px;background-color: #ffffff;margin-top: -5px;" onclick="eliminarvideo();">
                                    <?php endif; ?>
                                    <input type="file" style="display: none;" name="doctrailer" id="ftrailer" class="form-control">
                                    <input type="file" style="display: none;" name="docpreview" id="fpreview" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--div class="card" style="margin-top: 10px;">
                <div class="card-body">
                    <h4 class="card-title" style="margin: 0px">Ajustes</h4>
                    <p class="card-description" style="font-size: 12px;">Ajustes que modificaran la pulicación del producto.</p>
                </div>
            </div-->
        </div>
    </div>
</form>
<div class="modal" id="videow" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<script>
    var producto = "<?php echo $id; ?>";

    var imagenes = <?php echo json_encode($imagenes); ?>;
    var videos = <?php echo json_encode($videos); ?>;
    var documentos = <?php echo json_encode($documentos); ?>;
    var estdestacado = '<?php echo $data ? $data->estdestacado : 'N'; ?>';
    var fotovisible = '<?php echo $data ? $data->fotovisible : 'N'; ?>';

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

        if ($('#' + tipo + 'titulo').val() == '') {
            info('El campo título es requerido', 'info')
            return false;
        }

        formMultimedia.append('tipo', tipo);
        formMultimedia.append('titulo', $('#' + tipo + 'titulo').val());
        formMultimedia.append('descripcion', $('#' + tipo + 'descripcion').val());
        formMultimedia.append('estado', $('#' + tipo + 'estado').val());
        formMultimedia.append('exclusivo', $('#' + tipo + 'exclusivo').val());
        formMultimedia.append('orden', $('#' + tipo + 'orden').val());
        formMultimedia.append('id', producto);
        formMultimedia.append('uid', $('#' + tipo + 'id').val());

        $.ajax({
            url: '<?php echo url('cargararchivo'); ?>',
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
                producto: producto,
                tipo: tipo
            },
            beforeSend: function() {
                $(content).html("<div class='d-flex justify-content-center'><div class='spinner-border text-primary m-5' role='status'><span class='sr-only'>Cargando...</span</div></div>");
            },
            success: function(view) {
                $(content).html(view);
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
                    video.setAttribute('controls', true);
                    video.setAttribute('preload', 'auto');
                    video.setAttribute('poster', 'auto');
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

    function countChars(obj) {
        var maxLength = 170;
        var strLength = $(obj).val().length;
        var charRemain = (maxLength - strLength);

        if (charRemain < 0) {
            $("#charNum").html('<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres</span>');
        } else {
            $("#charNum").html(charRemain + ' caracteres restantes');
        }
    }

    function countCharsSumario(obj) {
        var maxLength = 320;
        var strLength = $(obj).val().length;
        var charRemain = (maxLength - strLength);

        if (charRemain < 0) {
            document.getElementById("charNumSumario").innerHTML = '<span style="color: red;">Has superado el límite de ' + maxLength + ' caracteres</span>';
        } else {
            document.getElementById("charNumSumario").innerHTML = charRemain + ' caracteres restantes';
        }
    }

    $(document).ready(function() {

        countChars($('#nombre'));
        countCharsSumario($('#sumario'));

        var tagnames = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: ['dog', 'pig', 'moose'],
            /*prefetch: {
                url: '<?php echo url('listar-tags'); ?>',
                //url: '<?php echo asset("AdminLTE-3.2.0/plugins/bootstrap-tagsinput-latest/examples/assets/citynames.json"); ?>',
                filter: function(list) {
                    return $.map(list, function(tag) {
                        return {
                            name: tag
                        };
                    });
                }
            }*/
        });


        tagnames.initialize();

        $('#tags').tagsinput({
            typeaheadjs: {
                name: 'tagnames',
                displayKey: 'name',
                valueKey: 'name',
                source: tagnames.ttAdapter()
            }
        });


        if (imagenes.length > 0) {
            seleccionarMultimedia(imagenes[0].id, 'I');
        }
        if (videos.length > 0) {
            seleccionarMultimedia(videos[0].id, 'V');
        }
        if (documentos.length > 0) {
            seleccionarMultimedia(documentos[0].id, 'F');
        }

        $('#estdestacado').bootstrapSwitch('state', (estdestacado == 'S' ? 1 : 0));
        $('#fotovisible').bootstrapSwitch('state', (fotovisible == 'S' ? 1 : 0));

        $('#destacado').change(function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.addEventListener('load', (event) => {
                $('#imgpreview').attr('src', event.target.result);
            });

            reader.readAsDataURL(file);
        });

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

        tinymce.init({
            selector: '#descripcion',
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            language: "es" ,
            images_upload_url: '<?php echo url('uploadblob'); ?>',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:12px }',
            relative_urls: false,
            convert_urls: false,
            powerpaste_allow_local_images: true,
            powerpaste_word_import: 'prompt',
            powerpaste_html_import: 'prompt',
            branding: false,
            link_assume_external_targets: true,
            images_upload_handler: function(blobInfo, success, failure) {
                var formData = new FormData();
                formData.append('archivo', blobInfo.blob());
                formData.append('id', '<?php echo $id; ?>');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url('uploadblob'); ?>',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(jqXHR, settings) {

                    },
                    success: function(data, textStatus, jqXHR) {
                        if (typeof data.mensajeError == 'undefined') {
                            success(data.ruta);
                        } else {
                            failure('Error: ' + data.mensajeError);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        failure('Error: ' + textStatus);
                    }
                });
            },
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            content_css: 'css/codepen.min.css',
            extended_valid_elements: "a[class|name|href|target|title|onclick|rel],script[type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder],img[class|src|border=0|class=img-responsive|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]",
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {

                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }


                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }


                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            image_class_list: [
               {title: 'Responsive', value: 'img-responsive'}
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 360,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });


        setInterval(() => {
            $.post("<?php echo url('verificar-ocupacion'); ?>", {
                id: producto
            }, function(response) {
                if (response == 'N') {
                    // puede ser condicionado con una alerta donde vuelva a retomar el control
                    location.href = "<?php echo url('/publicaciones'); ?>";
                }
            });
        }, 10000);

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

    function cambiar_estado(estado) {

        $.ajax({
            url: '<?php echo url("cambiarestado"); ?>',
            type: 'POST',
            data: {
                estado: estado,
                id: producto
            },
            beforeSend: function() {

            },
            success: function(view) {
                location.reload();
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


@endsection