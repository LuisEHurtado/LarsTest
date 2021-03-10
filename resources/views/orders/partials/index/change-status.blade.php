<div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="changeStatus"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar estado de la orden # @{{order_id}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="">Seleccione estado</label>
                        <select class="form-control" v-model="status">
                            <option value="">Seleccione</option>
                            <option value="0" v-if="original_status !==0">Pendiente</option>
                            <option value="1" v-if="original_status !==1">Aprobado</option>
                            <option value="2" v-if="original_status !==2">Rechazado</option>
                        </select>
                    </div>
                  
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="ChangeStatus" >Actualizar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar</button>
                
            </div>
        </div>
    </div>
</div>