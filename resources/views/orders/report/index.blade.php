<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Orden # {{$data->id}} </title>
    <link rel="stylesheet" href="style.css" media="all" />

    <style type="text/css">
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #0087C3;
        text-decoration: none;
    }

    body {
        width: 19cm;
        height: 20cm;
        text-transform: uppercase;
        margin: 0 auto;
        color: #000;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 11px;
        font-family: SourceSansPro;
    }

    header {
        padding: 0px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
    }

    #logo {
        float: right !important;
        margin-top: 8px;
    }

    #logo img {
        height: 70px;
    }

    #company {
        float: left;
        width: 30% !important;
    }


    #details {
        margin-bottom: 50px;
    }

    #client {
        padding-left: 6px;
        border-left: 6px solid #5c23c8;
        float: left;
    }

    #client .to {
        color: #000;
    }

    h2.name {
        font-size: 1.2em;
        font-weight: normal;
        margin: 0;
    }

    #invoice {
        float: right;
        text-align: left;
    }

    #invoice h1 {
        color: #000;
        font-size: 2em;
        line-height: 0.5em;
        font-weight: normal;
        margin: 0 0 10px 0;
    }

    #invoice .date {
        font-size: 1.1em;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 10px;
    }

    table tr:nth-child(2n-1) td {
        background: #fff;
    }

    table th,
    table td {
        text-align: center !important;
        font-size: 10px !important;
        border-bottom: 1px solid #C1CED9;
    }

    table th {
        padding: 0px 0px;
        color: #000;
        text-align: center;
        border-bottom: 1px solid #C1CED9;
        font-weight: normal;
    }

    table .service,
    table .desc {
        text-align: left;
    }

    table td {
        padding: 0px;
    }

    table td.service,
    table td.desc {
        vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }



    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }

    .address {}

    .text-uppercase {
        text-transform: uppercase;
    }

    .text-right {
        text-align: right;
    }

    .total {
        font-weight: normal;
        font-size: inherit;
    }

    .ah {
        color: #5c23c8 !important;
    }

    .punteado {
        border-top-style: dashed;
        border-top-width: 1px;
    }
    </style>

</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <h1> Orden # {{$data->id}} </h1>
            @if($data->status ===1)
                <h3>Aprobado</h3>
            @elseif($data->status ==0)
                <h3>Pendiente</h3>
            @elseif($data->status ==2)
                <h3>Anulada</h3>
            @endif
        </div>
        </h1>
        </div>
        <div id="company">
            <h2 class="name">{{$data->user->name}} </h2>
            <div><a>{{$data->user->email}}</a></div>
            
        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Emisor:</div>
                <h2 class="name">{{Auth::user()->name}}  </h2>
                <div class="email">{{Auth::user()->email}}</div>
            </div>
            <div id="invoice">
                <div class="date">Identificador : #{{$data->id}} </div>
                <div class="date">Fecha de emisión: {{date('d/m/Y')}} </div>
                @if($data->comment !='')
                <div class="motivo">Comentario :  {{$data->comment}} </div>
                @endif
                @if($data->tax >0)
                <div class="motivo">Impuesto :  {{$data->tax}} % </div>
                @endif
            </div>


        </div>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th>Precio de venta</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data->details as $detail)
                <tr>
                    <td> {{$detail->products->code}} </td>
                    <td> {{$detail->products->name}} </td>
                    <td> {{$detail->sales_price}} </td>
                    <td> {{$detail->quantity}} </td>
                    <td>{{$detail->quantity * $detail->sales_price}} USD</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right !important">Total</td>
                    <td>{{$data->total}} USD </td>
                </tr>
                

            </tbody>
        </table>
    </main>

</body>

</html>