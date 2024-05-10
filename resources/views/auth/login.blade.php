@extends('includes.baseform')
@section('content')

<div class="p-pages pb-5 login-page">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-lg-4 col-md-8 col-xs-12">
                <div class="bg-blanco-verdoso p-10 br-6">
                    <div class="border-dashed br-6">
                        <h1>Inicio de sesión</h1>  
                        <p>¿No tienes una cuenta?  <a class="enlace" href="/register">Regístrate aquí</a></p>               
                        <form class="mt-30" method="POST" action="{{ route('login') }}">
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

                            {{--<div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>

                                    <div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="form-group row mb-3">
                                    <label for="password" class="mb-2">{{ __('Password') }}</label>
                            
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">                        
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>                
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 
                                <div class="mb-3">
                                    <div class="d-md-flex justify-content-between">
                                        <div class="form-check d-flex align-items-center">
                                            <div>
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            </div>
                                            <div>
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Recuérdame') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mt-resp-3">
                                            @if (Route::has('password.request'))
                                                <a class="enlace " href="{{ route('password.request') }}">
                                                    {{ __('Olvidé mi contraseña') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-0 mt-40">
                                    <div class="d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn boton-principal">
                                            {{ __('Iniciar sesión') }}
                                        </button>  
                                    </div>
                                </div>
                        </form>
                    </div><!-- cierre .border-dashed -->
                </div><!-- cierre .bg-blanco-verdoso -->
            </div><!-- cierre .col-lg-4 -->
        </div>
    </div>
</div>
@endsection

@push('password-eye')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('togglePassword');

            togglePasswordButton.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
            });
        });
    </script>
@endpush

