<div class="modal-body">
    <video id="my-video" class="video-js" controls preload="auto" style="width: 100%;height: 400px;" width="400" height="400" poster="<?php echo ($video && $video['preview']) ? asset('/archivos/videos/' . $video['producto_id'] . '/' . $video['preview']) : ''; ?>" data-setup="{}">
        <source src="<?php echo ($video && $video['archivo']) ? asset('/archivos/videos/' . $video['producto_id'] . "/" . $video['archivo']) : ''; ?>" type="video/mp4" />
    </video>
</div>