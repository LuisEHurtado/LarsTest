@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Listado de productos</h1>
        <a href="{{route('product.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-tags fa-sm text-white-50"></i> Crear producto
        </a>
    </div>

    <!-- Content Row -->
    <div class="row" id="products">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Costo de compra</th>
                                    <th>Precio de venta</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(items,index) in products" v-if="products.length>0">
                                    <td>@{{items.code}} </td>
                                    <td>@{{items.name}} </td>
                                    <td>@{{items.buy_price}} USD</td>
                                    <td>@{{items.sales_price}} USD</td>
                                    <td>
                                        <button class="btn btn-primary" @click="GetProductById(items,index)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" @click="Destroy(items,index)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td colspan="5" class="text-center">Sin productos registrados</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        @include('products.partials.edit-fields')
    </div>
</div>
@endsection
@push('js-stack')
<script type="text/javascript">
const app = new Vue({
    el: "#products",

    data: {
        products: [],
        product: [],

    },
    mounted() {
        this.GetProducts();
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

        GetProducts() {
            axios.post("{{route('products.get')}}").then(response => {
                this.products = response.data.data
                console.log(this.products)
            }).catch(function(error) {
                console.log(error);
            });
        },
        GetProductById(items, index) {
            this.ShowModal();
            axios.post("{{route ('product.get.id')}}", {
                id: items.id
            }).then(response => {
                this.DestroyModal();
                this.product = response.data.data;
                $('#updateProduct').modal({
                    backdrop: 'static',
                    keyboard: false
                })
            }).catch(e => {
                console.log(e);
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
            });
        },

        Update() {
            this.ShowModal();
            axios.post("{{ route ('product.update')}}", {
                id: this.product.id,
                code: this.product.code,
                name: this.product.name,
                buy_price: this.product.buy_price,
                sales_price: this.product.sales_price,
                description: this.product.description,
            }).then(response => {
                this.DestroyModal();
                alert(response.data.message);
                $('#updateProduct').modal('hide');
                this.GetProducts();
            }).catch(e => {
                console.log(e);
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
            });
        },

        Destroy(items) {
            this.ShowModal();
            axios.post("{{ route ('product.destroy')}}", {
                id: items.id
            }).then(response => {
                this.DestroyModal();
                alert(response.data.message);
                this.GetProducts();
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