<div class="row" style="margin-left: 0px;">
    <?php if (count($data) > 0) : ?>
        <?php foreach ($data as $index => $key) : ?>
            <a style="display: none;" class="example-image-link<?php echo $index; ?>" href="<?php echo asset('/archivos/imagenes/' . $id . '/' . $key['archivo']); ?>" data-lightbox="example-set" data-title="">
                <div class="example-image" style="background-image: url('<?php echo asset('/archivos/imagenes/' . $id . '/' . $key['archivo']); ?>');height: 130px;background-size: cover;background-repeat: no-repeat;background-position: center center; border: 1px solid #ffffff;border-radius: 2px;"></div>
            </a>
            <div onclick="seleccionarMultimedia(<?php echo $key['id']; ?>,'I');" class="col-lg-12 multiitem imagenitem imgitem<?php echo $key['id']; ?> <?php echo ($index == 0) ? "active" : ""; ?>" style="cursor: pointer;border-bottom: 1px solid #2c2e33;">
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
        <div class="col-lg-12 multiitem imagenitem active" style="cursor: pointer;border-bottom: 1px solid #2c2e33;">
            <div class="text-center" style="padding-top: 25px;">
                <img style="width: 45px;" src="<?php echo asset('/images/icons/imagen2.png'); ?>">
                <p style="margin-top: 10px;font-size: 11px;line-height: 1;">Nueva Imagen</p>
            </div>
        </div>
    <?php endif; ?>
</div>