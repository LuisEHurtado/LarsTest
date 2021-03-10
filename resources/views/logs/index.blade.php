@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bitácora de cambios</h1>
    </div>

    <!-- Content Row -->
    <div class="row" id="logs">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tipo de operación</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(items,index) in logs" v-if="logs.length>0">
                                    <td>@{{items.type}} </td>
                                    <td>@{{items.user.name}} </td>
                                    
                                </tr>
                                <tr v-else>
                                    <td colspan="5" class="text-center">Sin  registros</td>
                                </tr>
                            </tbody>
                        </table>

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
    el: "#logs",

    data: {
        logs: [],

    },
    mounted() {
        this.GetLogs();
    },
    methods: {

        GetLogs() {
            axios.get("{{route('logs.get')}}").then(response => {
                this.logs = response.data.data
                console.log(this.logs);
            }).catch(function(error) {
                console.log(error);
            });
        },

    }
});
</script>

@endpush