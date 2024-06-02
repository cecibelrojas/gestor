    <section  class="content">
        <div class="filter-container">
            <div class="row">
            <?php if (count($lista) > 0) : ?>
                <?php foreach ($lista as $key) : ?>                         
                    <div class="filtr-item col-md-2" data-category="1" data-sort="<?php echo $key['titulo']; ?>" style="border: 1px solid #cdcdcd;padding: 8px;">
                      <a href="#" onclick="formulario(<?php echo $key['id']; ?>)" data-toggle="lightbox" data-title="<?php echo $key['titulo']; ?>">
                        <?php if ($key['tipo'] == 'I') : ?>
                           <img src="<?php echo env('APP_ADMIN') . "/archivos/imagenes_medios/" . $key['archivo']; ?>" class="img-fluid mb-2" style="height: 150px;width: 100%;object-fit: cover;"/>
                        <?php endif;  ?>
                        <?php if ($key['tipo'] == 'F') :  ?>
                           <center><img src="{{asset('images/icons/pdf.png')}}" class="img-fluid mb-2" style="height: 120px;;object-fit: cover;" alt="<?php echo $key['titulo']; ?>" /></center>
                            <div style="border-top: 1px solid #cdcdcd"><span class="m-auto" style="font-size: 12px;"><?php echo $key['titulo']; ?></span></div>
                         <?php endif;  ?>
                         <?php if ($key['tipo'] == 'V') :  ?>
                           <center><img src="{{asset('images/icons/uploadedvideo.png')}}" class="img-fluid mb-2" style="height: 120px;width: 70%;object-fit: cover;" alt="<?php echo $key['titulo']; ?>" /></center>
                            <div style="border-top: 1px solid #cdcdcd"><span class="m-auto" style="font-size: 12px;"><?php echo $key['titulo']; ?></span></div>
                         <?php endif;  ?>                            
                      </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            </div>
        </div>
        <div class="text-center" style="margin-top: 20px;margin-bottom: 20px">
            <p>
                <a href="#" class="btn btn-default btn-sm" id="enlaceajax">Cargar más</a>
            </p>
        </div>
        <div id="cargando" class="text-center" style="display:none; color: green;">Cargando...</div>
        <div id="destino"></div>
    </section>