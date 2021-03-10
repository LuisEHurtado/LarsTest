@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear orden</h1>
    </div>

    <!-- Content Row -->
    <div class="row" id="order-create">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    @include('orders.partials.create-fields')
                    <div class="row">
                        <div class="ml-auto">
                            <button class="btn btn-primary" @click="OpenSecurity">Procesar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js-stack')
<script type="text/javascript">
const app = new Vue({
    el: "#order-create",
    data: {
        products: [],
        tax:0,
        comment:'',
        orders: [],
        product_id: '',
        users: [],
        user_id: '',
        search_product: '',
        username: '',
        total: 0,
    },
    mounted() {
        this.GetUsers();
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
        Create() {
            this.ShowModal();
            axios.post("{{route('order.store')}}", {
                user_id: this.user_id,
                comment:this.comment,
                total:this.total,
                orders:JSON.stringify(this.orders),
                tax:this.tax,
            }).then(response => {
                this.DestroyModal();
                alert(response.data.message);
                window.location.href = '{{route ("orders") }}';
            }).catch(e => {
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
                console.log(e);
            });
        },
        OpenSecurity() {
            this.CalculateTotal();
            $('#ordersModal').modal('show');
        },
        DestroyOrderProducts(items,index){
            this.orders.splice(index,1);
            this.CalculateTotal();
        },
        OnChangeUsername(event) {
            let options = event.target.options;
            let selectedOption = options[options.selectedIndex];
            let selectedText = selectedOption.textContent;
            this.username = selectedText
        },

        SearchProducts() {
            this.ShowModal();
            axios.post("{{ route ('products.get')}}", {
                search_product: this.search_product,
            }).then(response => {
                this.DestroyModal();
                this.products = response.data.data;
                if (this.products.length > 0) {
                    $('#productsModal').modal('show');

                } else {
                    alert('No existen productos creados.');
                }
            }).catch(e => {
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
                console.log(e);
            });
        },
        AddOrders(items) {
            let subtotal = (parseFloat(items.quantity) * parseFloat(items.sales_price)).toFixed(2);
            this.orders.push({
                id: items.id,
                name: items.name,
                code: items.code,
                sales_price: items.sales_price,
                quantity: items.quantity,
                subtotal: subtotal,
                status:1
            });
            alert('Producto agregado');
            $('#productsModal').modal('hide');
        },
        GetUsers() {
            axios.get("{{route('users.get')}}").then(response => {
                this.users = response.data.data
                this.user_id = this.users[0].id;
                this.username = this.users[0].name;

            }).catch(function(error) {
                console.log(error);
            });
        },
        CalculateTotal() {
            let result = [];
            let operation = 0;
            for (var i = 0; i < this.orders.length; i++) {
                result.push(parseFloat(this.orders[i].subtotal));
            }
            result.forEach(function(result) {
                operation += result;
            });
            this.total=operation;
        },


    }
});
</script>

@endpush