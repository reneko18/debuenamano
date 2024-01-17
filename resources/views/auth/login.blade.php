@extends('includes.baseform')

@section('content')
<div class="container-fluid p-pages pb-5 login-page">
    <div class="row container mx-auto">
        <div class="col-6">
            <h1>Inicio de sesión</h1>  
            <p>¿No tienes una cuenta?  <a href="/register">Regístrate aquí</a></p>               
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>

                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>

                        <div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-tems-center justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recuérdame') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Has olvidado tu contraseña?') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div>
                            <button type="submit" class="btn boton-principal">
                                {{ __('Iniciar sesión') }}
                            </button>  
                        </div>
                    </div>
                </form>       
        </div>
    </div>
</div>
@endsection
