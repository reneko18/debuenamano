@extends('includes.baseform')

@section('content')
<div class="container p-pages pb-5">
    <div class="row">
        <div class="col-6"> 
            <h1>Registro</h1>  
            <p>¿Ya tienes una cuenta? <a href="/login">Inicia sesión aquí</a></p>             
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label for="name" class="form-label">{{ __('Nombre') }}</label>
                        <div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="lastname" class="form-label">{{ __('Apellido') }}</label>
                        <div>
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div> 
                <div class="mb-3">       
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
   
                <div class="row mb-3">
                    <div class="col">
                        <label for="password" class="form-label">{{ __('Password') }}</label>

                        <div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <label for="password-confirm" class="form-label">{{ __('Confirmar Password') }}</label>

                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="conditions" required>
                        <label class="form-check-label" for="conditions">
                            Acepto <a href="#">términos y condiciones y políticas de privacidad</a>
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div>
                        <button type="submit" class="btn boton-principal">
                            {{ __('Registrarse') }}
                        </button>
                    </div>
                </div>
            </form>            
        </div>
        <div class="col-6">
            <img src="{{asset('/img/imagen-registro.png')}}" alt="imagen de registro">
        </div>
    </div>
</div>
@endsection
