<div class="form-row">
    <div class="form-group col-md-4">
        <label for="">Seleccione el Usuario</label><br>
        <select class="form-control" v-model="user_id" @change="OnChangeUsername($event)"> 
            <option v-for="item in users" :value="item.id" :key="item.id" >
                @{{ item.name }}    
            </option>
        </select>
    </div>

    <div class="form-group col-md-4">
        <label for="">Impuesto</label><br>
        <input type="number" class="form-control" v-model="tax">
    </div>

    <div class="form-group col-md-4">
        <label for="">Buscar producto por código o nombre</label> <br>
        <div class="input-group mb-3">
            <input type="text" class="form-control" v-model="search_product" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" @click="SearchProducts">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="">Comentario</label>
        <textarea class="form-control" v-model="comment" cols="5" rows="4"></textarea>
    </div>

    <div class="table-responsive col-12 pt-5" v-if="orders.length>0">
        <h5 class="text-center">Productos asociados a la orden</h5>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Precio de vent</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order,indexOrders) in orders">
                    <td>@{{order.code}} </td>
                    <td>@{{order.name}} </td>
                    <td>@{{order.sales_price}} </td>
                    <td>@{{order.quantity}} </td>
                    <td>@{{order.subtotal}} </td>
                    <td>
                        <button class="btn btn-danger" @click="DestroyOrderProducts(order,indexOrders)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@include('orders.partials.product-modals')
@include('orders.partials.orders-modal')