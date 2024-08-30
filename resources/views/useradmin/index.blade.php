@extends('includes.baseform')
@section('title')
Admin Usuario - De Buena Mano
@endsection

@section('content')
<section class="container-fluid p-pages pb-5">
    <div class="container mx-auto">
        <div class="col-8">
            <h2>Panel de administración</h2>
            <p>Curabitur placerat risus nec orci viverra porttitor. Integer facilisis lacus non ex sodales lobortis. Phasellus facilisis pulvinar ex, ut pretium eros vehicula.</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-1">
                <a href="" data-bs-toggle="modal" data-bs-target="#modalImageProfil" title="Modificar la imagen de perfil" class="overlay-img-profil">
                    <div id="profil-img" class="col-lg-3 col-sm-3 position-relative">
                        @if($user->profil_image)
                            <img src="{{ asset($user->profil_image) }}" alt="imagen de perfil" class="real-img-profil">
                        @else 
                            <img src="{{ asset('/img/icon-profil.png') }}" alt="imagen de perfil" class="img-profile">
                        @endif
                    </div>
                </a>
            </div>            
            <div class="col-4 align-self-center">
                <h2>{{ $user->name }} {{ $user->lastname }}</h2>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid">
    <div class="container mx-auto">        
        <admin-user :user-id="{{ $user->id }}" :user-slug="'{{ $user->slug }}'"/>  
    </div>
</section>
  <!-- Modal Image Profil -->
  <add-profil-photo-user :user-slug="'{{ $user->slug }}'"/>
@endsection

