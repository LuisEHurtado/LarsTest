<div class="modal fade" id="viewOrder" tabindex="-1" role="dialog" aria-labelledby="viewOrder"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Orden # @{{order_id}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" v-if="order !==''">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="">Usuario</label>
                        <input type="text" readonly class="form-control" v-model="username">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="">Impuesto</label>
                        <input type="text" readonly class="form-control" v-model="tax">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="">Total</label>
                        <input type="text" readonly class="form-control" v-model="total">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="">Comentario</label>
                        <input type="text" readonly class="form-control" v-model="comment">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Precio de venta</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(items,index) in order.details">
                                <td>@{{items.products.code}} </td>
                                <td>@{{items.products.name}} </td>
                                <td>@{{items.sales_price}} USD</td>
                                <td>@{{items.quantity}} </td>
                                <td>@{{items.quantity * parseFloat(items.sales_price)}} </td>
                            </tr>
                            
                        </tbody>

                    </table>
                </div>
                

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar</button>
                
            </div>
        </div>
    </div>
</div>