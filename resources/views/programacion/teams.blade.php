<style>
    .checkteam {
        text-align: center;
        border: 1px solid #b9b9b9;
        border-radius: 4px;
        padding: 5px;
        background-color: #ffffff;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .checkteam:hover {
        background-color: #f1f1f1;
    }

    .teamactive {
        border: 2px solid #2196f3;
    }
</style>
<div class="row">
    <?php if (count($teams) > 0) : ?>
        <?php foreach ($teams as $index => $det) : ?>
            <div class="col-lg-4">
                <div class="checkteam team<?php echo $det['id']; ?>">
                    <div onclick="seleccionar(<?php echo $det['id']; ?>);">
                        <input type="checkbox" class="form-control selectedteam" ciudad="<?php echo $det['ciudad']; ?>" sede="<?php echo $det['sede']; ?>" id="team<?php echo $det['id']; ?>" style="width: 12px;height: 15px;" value="<?php echo $det['id']; ?>">
                        <label style="float: right;position: absolute;top: 3px;right: 15px;font-size: 12px;color: #2196f3;font-weight: bold;" id="casa"></label>
                        <img id="teamimage<?php echo $det['id']; ?>" style="object-fit: contain;width: 80px;height: 80px;" src="<?php echo url('/') . $det['logo']; ?>"><br>
                        <b style="margin-bottom: 10px;font-size: 13px;" originalname="<?php echo $det['nombre']; ?>" id="teamname<?php echo $det['id']; ?>"><?php echo $det['nombre2']; ?></b>
                        <hr>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="seleccionarcasa(this,<?php echo $det['id']; ?>)" id="casa<?php echo $det['id']; ?>" class="custom-control-input">
                        <label class="custom-control-label" style="font-size: 13px;color: #2196f3;" for="casa<?php echo $det['id']; ?>">Visitante</label>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script>
    equipos = [];


    function seleccionarcasa(element, id) {

        var casa = 'N';
        if (!$(element).is(':checked')) {
            casa = 'S';
        }

        $.each(equipos, function(item, key) {
            if (key.team == id) {
                key.casa = casa;
            }
        });

        buildteams();
    }

    function seleccionar(id) {

        var checked = true;
        var casa = 'S';
        if ($('#casa' + id).is(':checked')) {
            casa = 'N';
        }
        $('.team' + id).addClass('teamactive');
        if ($('#team' + id).is(':checked')) {
            checked = false;
            $('.team' + id).removeClass('teamactive');
        }
        $('#team' + id).prop('checked', checked);

        var tempteams = [];

        $.each(equipos, function(item, key) {
            if (key.team != id) {
                tempteams.push(key);
            }
        });

        equipos = tempteams;

        if (checked) {
            equipos.push({
                team: $('#team' + id).val(),
                casa: casa,
                image: $('#teamimage' + id).attr('src'),
                name: $('#teamname' + id).attr('originalname'),
                ciudad: $('#team' + id).attr('ciudad'),
                sede: $('#team' + id).attr('sede'),
            });
        }

        buildteams();
    }
</script>