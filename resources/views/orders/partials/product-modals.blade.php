<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="productsModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Productos disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Precio de venta</th>
                                <th>Cantidad</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(items,index) in products">
                                <td>@{{items.code}} </td>
                                <td>@{{items.name}} </td>
                                <td>@{{items.sales_price}} USD</td>
                                <td>
                                    <input type="number" class="form-control" min=0 v-model="items.quantity">
                                </td>
                                <td>
                                    <button class="btn btn-primary" title="Agregar el producto a la orden" @click="AddOrders(items)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
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