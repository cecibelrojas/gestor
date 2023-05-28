@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <a href="{{url('/')}}" class="logo logo-admin">
                                        <img src="{{asset('assets/images/escudo2.png')}}" height="100" alt="logo" class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 fw-semibold text-white font-18">Restablecer contraseña</h4>   
                                    <p class="text-muted  mb-0">¡Ingrese su correo electrónico y se le enviarán las instrucciones!</p>  
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                 @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form class="my-4"  method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="username">Correo Electrónico</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="Correo Electrónico" placeholder="Correo Electrónico" autofocus>   
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror                            
                                    </div><!--end form-group--> 

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" >Enviar enlace de restablecimiento de contraseña <i class="fas fa-sign-in-alt ms-1"></i></button>
                                        </div><!--end col--> 
                                    </div> <!--end form-group-->                           
                                </form><!--end form-->
                                <div class="text-center text-muted">
                                    <p class="mb-1"><a href="{{url('/')}}" class="text-primary ms-2">Iniciar Sesión</a></p>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div>
@endsection
