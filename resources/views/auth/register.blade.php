@extends('includes.baseform')

@section('content')
<div class="bg-blanco-verdoso pb-100">   
    <div class="container p-pages pb-5">
        <div class="row d-flex align-items-center">
            <div class="col-lg-5 offset-lg-1">
                    <h1>Registro</h1>  
                    <p>¿Ya tienes una cuenta? <a class="enlace" href="/login">Inicia sesión aquí</a></p>             
                    <form class="mt-30" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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
                        <div class="row">
                            <div class="col-md-12">       
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
                        </div>
        
                        <div class="row">
                            <div class="col-md-12">
                                <label for="password" class="form-label">{{ __('Contraseña') }}</label>

                                <div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <p class="txt-small">
                                        <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.0035 6.61865H1.90352C1.18555 6.61865 0.603516 7.20068 0.603516 7.91865V12.4687C0.603516 13.1866 1.18555 13.7687 1.90352 13.7687H11.0035C11.7215 13.7687 12.3035 13.1866 12.3035 12.4687V7.91865C12.3035 7.20068 11.7215 6.61865 11.0035 6.61865Z" fill="#747E67" stroke="#747E67" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M3.20361 6.61855V4.01855C3.20361 3.1566 3.54602 2.32995 4.15552 1.72046C4.76501 1.11096 5.59166 0.768555 6.45361 0.768555C7.31557 0.768555 8.14222 1.11096 8.75171 1.72046C9.3612 2.32995 9.70361 3.1566 9.70361 4.01855V6.61855" stroke="#747E67" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>Contraseña de al menos 8 caracteres</span>
                                    </p>
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>

                                <div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="conditions" required>
                                <label class="form-check-label mt-24" for="conditions">
                                    Acepto los <a class="enlace" href="#">términos y condiciones y políticas de privacidad</a>
                                </label>
                            </div>
                        </div>

                        <div class="mb-0 mb-0 mt-40">
                            <div class="d-md-flex justify-content-md-end">
                                <button type="submit" class="btn boton-principal">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>            
            </div>
            <div class="col-lg-5 d-none d-lg-block offset-lg-1">
                <img class="img-fluid" src="{{asset('/img/imagen-registro.png')}}" alt="imagen de registro">
            </div>
        </div>
    </div>
</div>
@endsection
