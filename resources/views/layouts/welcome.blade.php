<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A&H - Punto de Venta</title>
    <!-- Custom styles for this template-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('welcome/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('welcome/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('welcome/css/util.css') }}">
    
    @yield('scripts')
    
    <!-- Styles -->
    
</head>

<body>
    @yield('content')
    <div id="dropDownSelect1"></div>
    <!-- Bootstrap core JavaScript-->
    <script src=" {{ asset('welcome/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src=" {{ asset('welcome/vendor/bootstrap/js/popper.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src=" {{ asset('welcome/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src=" {{ asset('welcome/js/main.js') }}"></script>
    @stack('js-stack')
</body>
</html>