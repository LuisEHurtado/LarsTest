@extends('layouts.welcome')
@section('title', 'Bienvenido')
@section('content')
<div class="limiter" id="login">
    <div class="container-login100" style="background-image: url({{URL::asset('welcome/images/bg-3.jpg')}});">
        @if (Auth::check() ==false)
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="mx-auto">
                        <strong class="login100-form-title">
				Bienvenido
			</strong><br>
                        <strong class="login100-form-title"> <i>Acceda al sistema</i> </strong>

                    </div>
                </div>
                <!-- <span class="login100-form-title">
                 Punto de Venta
                </span> -->
                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Email
                    </span>
                </div>
                <div class="wrap-input100 validate-input">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>

                <div class="p-t-13 p-b-9">
                    <span class="txt1">
                        Password
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn m-t-17">
                    <button class="login100-form-btn" type="submit">
                        Entrar
                    </button>
                </div>
            </form>
            <div class="pt-4 alerts row">
                <div class="mx-auto">
                    
                </div>
            </div>
        </div>
        @else
        <div class="card card-waves mb-4 mt-5">
            <div class="card-body p-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="text-primary">¡A&H Software House te da la bienvenida!</h2>
                        <p class="text-gray-700">
                         El sistema esta listo para comenzar a facturar.
                        </p>
                        <a class="btn btn-primary" href="{{route('point-of-sale')}} ">
                            Ir al sistema
                        </a>
                    </div>
                    <div class="col d-none d-lg-block mt-xxl-n4">
                        <img class="img-fluid px-xl-4 mt-xxl-n5"
                            src="{{asset('welcome/images/statistics.svg')}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-4 alerts">
            
        </div>
        
        @endif
    </div>
</div>
@endsection
@push('js-stack')
@endpush