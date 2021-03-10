@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listado de ordenes</h1>
        <a href="{{route('orders.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-tags fa-sm text-white-50"></i> Crear orden
        </a>
    </div>

    <!-- Content Row -->
    <div class="row" id="orders">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Total</th>
                                    <th>Impuesto</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(order,index) in orders">
                                    <td>@{{order.user.name}} </td>
                                    <td>@{{order.total}} USD </td>
                                    <td>@{{order.tax}} %</td>
                                    <td v-if="order.status ===1">
                                        <span class="badge badge-success">Aprobado</span>
                                    </td>
                                    <td v-else-if="order.status ===0">
                                        <span class="badge badge-warning">Pendiente</span>
                                    </td>
                                    <td v-else-if="order.status ===2">
                                        <span class="badge badge-danger">Anulado</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" title="Ver Orden" @click="ViewOrder(order.id)">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <a @click="download_order" class="btn btn-info" title="Descargar orden">
                                            <form action="{{route('download.order')}}" method="post"
                                                id="download_order" target="_blank">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="order_id" v-model="order.id"
                                                    class="form-control">

                                                <i class="fas fa-fw fa-file-pdf"></i>

                                            </form>
                                        </a>
                                        <button class="btn btn-info" title="Cambiar estado de la orden"
                                            @click="SetStatus(order,index)">
                                            <i class="fas fa-exchange-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        @include('orders.partials.index.view-order')
        @include('orders.partials.index.change-status')
    </div>
</div>
@endsection
@push('js-stack')
<script type="text/javascript">
const app = new Vue({
    el: "#orders",

    data: {
        orders: [],
        order: [],
        username: '',
        total: '',
        order_id: '',
        tax: 0,
        comment: '',
        status: '',
        original_status: '',

    },
    mounted() {
        this.GetOrders();
    },
    methods: {
        ShowModal() {
            $('body').loadingModal({
                text: 'Procesando Información, Por favor espere.'
            }).loadingModal('animation', 'wave').loadingModal('backgroundColor', '#4e73df');
            var delay = function(ms) {
                return new Promise(function(r) {
                    setTimeout(r, ms)
                })
            };
            var time = 2000;
            delay(time)
        },
        DestroyModal() {
            $('body').loadingModal('hide');
            $('body').loadingModal('destroy');
        },
        download_order() {
            document.getElementById("download_order").submit();
        },
        GetOrders() {
            axios.get("{{route('orders.get')}}").then(response => {
                this.orders = response.data.data
            }).catch(function(error) {
                console.log(error);
            });
        },
        ViewOrder(id) {
            this.ShowModal();
            axios.post("{{route('order.get.id')}}", {
                id: id,
            }).then(response => {
                this.DestroyModal();
                this.order = response.data.data;
                this.order_id = this.order.id;
                this.username = this.order.user.name;
                this.total = this.order.total;
                this.tax = this.order.tax;
                this.comment = this.order.comment;
                $('#viewOrder').modal('show');
            }).catch(e => {
                console.log(e);
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
            });
        },
        SetStatus(items, index) {
            this.order_id = items.id;
            this.original_status = items.status;
            $('#changeStatus').modal('show');
        },
        ChangeStatus() {
            this.ShowModal();
            axios.post("{{route('order.change.status')}}", {
                id: this.order_id,
                status: this.status
            }).then(response => {
                this.DestroyModal();
                alert(response.data.message);
                this.GetOrders();
                this.status = '';
                this.status_original = '';
                $('#changeStatus').modal('hide');
            }).catch(e => {
                console.log(e);
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
            });
        },
    }
});
</script>

@endpush