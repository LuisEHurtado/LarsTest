<div class="modal fade" id="ordersModal" tabindex="-1" role="dialog" aria-labelledby="ordersModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Orden a procesar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Usuario</label>
                        <input type="text" readonly class="form-control" v-model="username">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Total</label>
                        <input type="text" readonly class="form-control" v-model="total">
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
                            <tr v-for="(itemsOrders,index) in orders">
                                <td>@{{itemsOrders.code}} </td>
                                <td>@{{itemsOrders.name}} </td>
                                <td>@{{itemsOrders.sales_price}} USD</td>
                                <td>@{{itemsOrders.quantity}} </td>
                                <td>@{{itemsOrders.subtotal}} </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="Create">Procesar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar</button>
                
            </div>
        </div>
    </div>
</div>