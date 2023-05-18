<div class="modal fade" id="modalFastEvent" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Título do modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="message"></div>

                <form id="formFastEvent">

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="title" style="font-size: 12px;font-weight: bold;">Titulo</label>
                            <input type="text" name="title" class="form-control" id="title">
                            <input type="hidden" name="id">
                        </div>
                        <div class="col-lg-12">
                            <label for="start" style="font-size: 12px;font-weight: bold;">Hora Inicial</label>
                            <input type="text" name="start" class="form-control time" id="start">
                        </div>
                        <div class="col-lg-12">
                            <label for="end" style="font-size: 12px;font-weight: bold;">Hora Final</label>
                            <input type="text" name="end" class="form-control time" id="end">
                        </div>
                        <div class="col-lg-12">
                            <label for="color" style="font-size: 12px;font-weight: bold;">Color del Evento</label>
                            <input type="color" name="color" class="form-control" id="color">
                        </div>
                      
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger deleteFastEvent">Eliminar</button>
                <button type="button" class="btn btn-primary saveFastEvent">Guardar</button>
            </div>
        </div>
    </div>
</div>
