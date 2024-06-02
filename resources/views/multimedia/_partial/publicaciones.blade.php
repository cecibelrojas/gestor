                        <table class="table table-responsive-lg" id="maintable">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Archivo</th>
                                    <th>Títuloo</th>
                                    <th>Original</th>
                                    <th>Autor</th>
                                    <th>Fecha</th>
                                    <th style="width: 15%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($lista) > 0) : ?>
                                    <?php foreach ($lista as $key) : ?>
                                        <tr>
                                            <td>
                                                <?php if ($key['tipo'] == 'I') : ?>
                                                   <img src="<?php echo env('APP_ADMIN') . "/archivos/imagenes_medios/" . $key['archivo']; ?>" class="img-fluid mb-2" style="width: 60%;object-fit: cover;"/>
                                                <?php endif;  ?>
                                                <?php if ($key['tipo'] == 'F') :  ?>
                                                   <img src="{{asset('images/icons/document.png')}}" class="img-fluid mb-2" style="height: 80px;object-fit: cover;" alt="<?php echo $key['titulo']; ?>" />
                                                 <?php endif;  ?>
                                                 <?php if ($key['tipo'] == 'V') :  ?>
                                                   <img src="{{asset('images/icons/uploadedvideo.png')}}" class="img-fluid mb-2" style="width: 50%;object-fit: cover;" alt="<?php echo $key['titulo']; ?>" />
                                                 <?php endif;  ?> 
                                            </td>
                                            <td><?php echo $key['titulo']; ?></td>
                                            <td><?php echo $key['originalname']; ?></td>
                                            <td><?php echo $key['creador']; ?></td>
                                            <td><span><?php echo $key['created_at']; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="formulario(<?php echo $key['id']; ?>)"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-sm btn-danger" onclick="eliminar(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
<script>
    var table = $('#maintable').DataTable({
        pageLength: 50,
        order: [
            [6, 'desc']
        ]

    });
</script>