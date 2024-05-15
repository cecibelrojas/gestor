<div class="row" style="margin-left: 0px;">
    <?php if (count($data) > 0) : ?>
        <?php foreach ($data as $index => $key) : ?>
            <div onclick="seleccionarMultimedia(<?php echo $key['id']; ?>,'F')" class="col-lg-12 multiitem documentoitem docitem<?php echo $key['id']; ?> <?php echo ($index == 0) ? "active" : ""; ?>" onclick="opendocumento(<?php echo $key['id']; ?>);" style="cursor: pointer;border-bottom: 1px solid #2c2e33;">
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
        <div class="col-lg-12 multiitem imagenitem active" style="cursor: pointer;border-bottom: 1px solid #2c2e33;">
            <div class="text-center" style="padding-top: 25px;">
                <img style="width: 45px;" src="<?php echo asset('/images/icons/document2.png'); ?>">
                <p style="margin-top: 10px;font-size: 11px;line-height: 1;">Nuevo Documento</p>
            </div>
        </div>
    <?php endif; ?>
</div>