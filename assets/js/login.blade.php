@extends('layouts.app')

@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="border-color: <?php echo env('COLOR_BG_PRIMARY'); ?>;">
    <div class="card-header text-center">
      <a href="{{url('/')}}" class="h1"><img src="{{asset('img/epale1.png')}}"> </a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar Sesión</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control email_login @error('email') is-invalid @enderror" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: <?php echo env('COLOR_BG_PRIMARY'); ?> !important; border-color: <?php echo env('COLOR_BG_PRIMARY'); ?> !important;">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</div>
<script src="{{url('/')}}/js/login.js"></script>
<!-- /.login-box -->
@endsection