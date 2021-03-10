@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Crear producto</h1>
    </div>

    <!-- Content Row -->
    <div class="row" id="product-create">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    @include('products.partials.create-fields')
                    <div class="row">
                        <div class="mx-auto">
                            <button class="btn btn-primary" @click="Create">Guardar</button>
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
    el: "#product-create",

    data: {
        code: '',
        name: '',
        buy_price: 0,
        sales_price: 0,
        description: '',
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
            axios.post("{{ route ('product.store')}}", {
                code: this.code,
                name: this.name,
                buy_price: this.buy_price,
                sales_price: this.sales_price,
                description: this.description,
            }).then(response => {
                this.DestroyModal();
                alert(response.data.message)
                window.location.href = '{{route ("products") }}';
                //toastr.success(response.data.message);
                
            }).catch(e => {
                console.log(e);
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
            });
        }

    }
});
</script>

@endpush