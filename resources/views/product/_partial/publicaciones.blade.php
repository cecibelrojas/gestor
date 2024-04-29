here
<table class="table table-responsive-lg" id="maintable">
    <thead>
        <tr>
            <th style="font-size: 12px;">ID</th>
            <th style="font-size: 12px;">{!! trans('messages.nombre') !!}</th>
            <th style="font-size: 12px;">{!! trans('messages.categorias') !!}</th>
            <th style="font-size: 12px;">{!! trans('messages.creador') !!}</th>
            <th style="font-size: 12px;">{!! trans('messages.ocupado') !!}</th>
            <th style="font-size: 12px;">{!! trans('messages.publicacion') !!}</th>
            <th style="width: 15%;"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($lista) > 0) : ?>
            <?php foreach ($lista as $key) : ?>
                <?php if ($key['papelera'] != 'P') : ?>
                    <tr>
                        <td><?php echo $key['id']; ?></td>
                        <td><?php echo $key['nombre']; ?></td>
                        <td style="font-size: 12px;"><?php echo $key['categoriades']; ?></td>
                        <td style="font-size: 12px;"><?php echo $key['creador']; ?> <br> <span><?php echo $key['created_at']; ?></span></td>
                        <td style="font-size: 12px;"> <?php if ($key['escritor'] != '') { ?><i class="fas fa-lightbulb" style="color:#ffd504"></i> <?php echo $key['escritor']; ?><?php  } ?></td>
                        <td><?php
                            switch ($key['estado']) {
                                case 'A':
                                    if (auth()->user()->rol == 'A' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                        echo "<span class='right badge badge-success' style='font-size:14px; color: #fff'>Publicada</span>";
                                        break;
                                    }
                                case 'I':
                                    if (auth()->user()->rol == 'A' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                        echo "<span class='right badge badge-warning' style='font-size:14px; color: #fff'>Borrador</span>";
                                        break;
                                    }
                                case 'R':
                                    if (auth()->user()->rol == 'A' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                        echo "<span class='right badge badge-info' style='background-color:#9917b8!important; font-size:14px; color: #fff'>Para Corrección</span>";
                                        break;
                                    }
                                case 'P':
                                    if (auth()->user()->rol == 'A' || auth()->user()->rol == 'C' || auth()->user()->rol == 'D' || auth()->user()->rol == 'E') {
                                        echo "<span class='right badge badge-primary' style='background-color:#007bff!important; font-size:14px; color: #fff'>Publicada</span>";
                                        break;
                                    }

                                default:
                                    echo "----";
                                    break;
                            }
                            ?>
                        </td>
                        <td>

                            <a class="btn btn-sm btn-info" href="<?php echo url('/publicacion') . "/" . $key['id']; ?>"><i class="fa fa-edit"></i></a>

                            <?php if (auth()->user()->rol == 'A' ||  auth()->user()->rol == 'E') { ?>
                                <button class="btn btn-sm btn-danger" onclick="deshabilitando(<?php echo $key['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                            <?php } ?>
                            <?php if (auth()->user()->rol == 'A' ||  auth()->user()->rol == 'E') { ?>
                                <?php if ($key['escritor'] != '') { ?>
                                    <button class="btn btn-sm btn-success" onclick="trabajador(<?php echo $key['id']; ?>)"><i class="fas fa-unlock"></i></button>
                                <?php  } ?>
                            <?php  } ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
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