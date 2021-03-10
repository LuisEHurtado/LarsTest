<div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="updateProduct"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="product =''">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Código</label>
                        <input type="text" class="form-control" v-model="product.code">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Costo de compra</label>
                        <input type="text" class="form-control" v-model="product.buy_price">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Precio de venta</label>
                        <input type="text" class="form-control" v-model="product.sales_price">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="">Descripción</label>
                        <input type="text" class="form-control" v-model="product.description">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="product =''">Cerrar</button>
                <button type="button" class="btn btn-primary" @click="Update">Actualizar</button>
            </div>
        </div>
    </div>
</div>